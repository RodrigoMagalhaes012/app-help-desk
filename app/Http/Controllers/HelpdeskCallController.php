<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateHelpdeskCallFormRequest;
use App\Models\HelpdeskCall;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpdeskCallController extends Controller
{

    protected $model;

    public function __construct(HelpdeskCall $helpdeskCall)
    {
        $this->model = $helpdeskCall;
    }

    public function index(Request $request)
    {
        $helpdeskCall = $this->model
            ->getHelpdesk(
                search: $request->search ?? ''
            );

        return view('helpdesk.index', compact('helpdeskCall'));
    }

    public function show($id)
    {
        if (!$helpdeskCall = $this->model->find($id)) {
            return redirect()->route('helpdesk.index');
        }

        return view('helpdesk.show', compact('helpdeskCall'));
    }

    public function create()
    {
        return view('helpdesk.create');
    }

    public function store(StoreUpdateHelpdeskCallFormRequest $request)
    {

        $user = Auth::user();

        if ($user->user_type !== 'client') {
            return redirect()->back()->withErrors(['message' => 'Apenas usuários com o tipo "cliente" podem abrir novos chamados.']);
        }

        $agent =  $this->assignAgent();

        $data = $request->all();

        $data['user_id_client'] =  $user->id;
        $data['user_id_agent'] = $agent->id;
        $helpdeskCall = $this->model->create($data);

        return redirect()->route('helpdesk.index');
    }

    public function edit($id)
    {
        if (!$helpdeskCall = $this->model->find($id)) {
            return redirect()->route('helpdesk.index');
        }

        $agents = new User();
        $agents = $agents->getAgent();

        return view('helpdesk.edit', compact(['helpdeskCall', 'agents']));
    }

    public function update(StoreUpdateHelpdeskCallFormRequest $request, $id)
    {
        if (!$helpdeskCall = $this->model->find($id)) {
            return redirect()->route('helpdesk.index');
        }

        $helpdeskCall->update($request->all());

        return redirect()->route('helpdesk.index');
    }

    public function destroy($id)
    {
        if (!$helpdeskCall = $this->model->find($id)) {
            return redirect()->route('helpdesk.index');
        }

        $helpdeskCall->delete($id);

        return redirect()->route('helpdesk.index');
    }

    public function countCall()
    {
        $this->model->openHelpsCount();
    }

    public function assignAgent()
    {
        $agents = User::where('user_type', 'agent')->get();
        $minCalls = PHP_INT_MAX;
        $minAgent = null;
        foreach ($agents as $agent) {
            $agentCalls = HelpdeskCall::where('user_id_agent', $agent->id)->count();
            if ($agentCalls < $minCalls) {
                $minCalls = $agentCalls;
                $minAgent = $agent;
            }
        }
        return $minAgent;
    }
}
