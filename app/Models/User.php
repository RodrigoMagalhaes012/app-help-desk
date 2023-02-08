<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'password',
        'phone_number',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUsers(string|null $search = '')
    {
        $users = $this->withCount([
            'helpdeskCalls as openCallsCount' => function ($query) {
                $query->where('status', 'Open')
                    ->where('created_at', '>', Carbon::now()->subHours(24));
            },
            'helpdeskCalls as inProgressCallsCount' => function ($query) {
                $query->where('status', 'In Progress');
            },
            'helpdeskCalls as resolvedCallsCount' => function ($query) {
                $query->where('status', 'Resolved');
            },
            'helpdeskCalls as overdueCallsCount' => function ($query) {
                $query->where('created_at', '<', Carbon::now()->subHours(24))
                    ->where('status', '!=', 'Resolved');
            },
        ])->where(function ($query) use ($search) {
            if ($search) {
                $query->where('email', $search)
                    ->orWhere('name', 'LIKE', "%{$search}%");
            }
        })->paginate();

        return $users;
    }

    public function helpdeskCalls()
    {
        return $this->hasMany(HelpdeskCall::class, 'user_id_agent');
    }

    public function getAgent()
    {
        $agents = $this->where('user_type', 'agent')->get();
        return  $agents;
    }
}
