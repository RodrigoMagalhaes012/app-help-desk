<?php

namespace App\Http\Controllers;

use App\Models\HelpdeskCall;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $model;

    public function __construct(HelpdeskCall $helpdeskCall)
    {
        $this->model = $helpdeskCall;
    }

    public function index()
    {
        $openHelpsCount = $this->model->openHelpsCount();
        $inProgressHelpsCount = $this->model->inProgressHelpsCount();
        $overdueHelpsCount = $this->model->overdueHelpsCount();
        $resolvedHelpsCount = $this->model->resolvedHelpsCount();

        return view('dashboard', compact([
            'openHelpsCount',
            'inProgressHelpsCount',
            'overdueHelpsCount',
            'resolvedHelpsCount'
        ]));
    }
}
