<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HelpdeskCall extends Model
{
    use HasFactory;

    protected $table = 'helpdesk_calls';

    protected $fillable = [
        'subject',
        'description',
        'status',
        'user_id_agent',
        'user_id_client'
    ];

    public function userAgent()
    {
        return $this->belongsTo(User::class, 'user_id_agent');
    }

    public function userClient()
    {
        return $this->belongsTo(User::class, 'user_id_client');
    }

    public function getHelpdesk(string|null $search = '')
    {
        $helps = $this->with(['userClient', 'userAgent'])
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('subject', $search);
                    $query->orWhere('description', 'LIKE', "%{$search}%");
                }
            })
            ->when(request('status') === 'Open', function ($query) {
                return $query->where('status', 'Open')
                    ->where('created_at', '>', Carbon::now()->subHours(24));
            })
            ->when(request('status') === 'In Progress', function ($query) {
                return $query->where('status', 'In Progress');
            })
            ->when(request('status') === 'Resolved', function ($query) {
                return $query->where('status', 'Resolved');
            })
            ->when(request('status') === 'Overdue', function ($query) {
                return $query->where('status', 'Open')
                    ->where('created_at', '<', Carbon::now()->subHours(24));
            })
            ->when(Auth::user()->user_type == 'client', function ($query) {
                $query->where('user_id_client', Auth::id());
            })
            ->paginate();

        return $helps;
    }

    public function openHelpsCount()
    {
        $userId = Auth::user()->id;

        $openHelpsCount =
            $this->where('created_at', '>', Carbon::now()->subHours(24))
            ->where('status', '=', 'Open')
            ->when(Auth::user()->user_type == 'client', function ($query) use ($userId) {
                return $query->where('user_id_client', $userId);
            })
            ->count();
        return $openHelpsCount;
    }

    public function inProgressHelpsCount()
    {
        $userId = Auth::user()->id;

        $openHelpsCount = $this->where('status', 'In Progress')
            ->when(Auth::user()->user_type == 'client', function ($query) use ($userId) {
                return $query->where('user_id_client', $userId);
            })
            ->count();
        return $openHelpsCount;
    }
    public function overdueHelpsCount()
    {
        $userId = Auth::user()->id;

        $openHelpsCount = $this->where('created_at', '<', Carbon::now()->subHours(24))
            ->where('status', '!=', 'Resolved')
            ->when(Auth::user()->user_type == 'client', function ($query) use ($userId) {
                return $query->where('user_id_client', $userId);
            })
            ->count();
        return $openHelpsCount;
    }

    public function resolvedHelpsCount()
    {
        $userId = Auth::user()->id;
        $openHelpsCount = $this->where('status', 'Resolved')
            ->when(Auth::user()->user_type == 'client', function ($query) use ($userId) {
                return $query->where('user_id_client', $userId);
            })
            ->count();
        return $openHelpsCount;
    }
}
