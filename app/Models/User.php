<?php

namespace App\Models;

use App\Interfaces\Model as ModelContract;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements ModelContract
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Static method that enables me to tap into the life cycle events of the model for background processing
     */
    protected static function booted()
    {
        static::saving(function (User $user) {
            if ($user->isDirty(['password'])) {
                $user->password = Hash::make($user->password);
            }
        });
    }

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class, 'workspace_user');
    }

    public function channels()
    {
        return $this->belongsToMany(WorkspaceChannel::class, 'channel_user','channel_id', 'user_id');
    }
}
