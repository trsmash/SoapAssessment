<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkspaceChannel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workspace_id',
        'name',
        'description'
    ];

    protected static function booted()
    {
        static::creating(function (WorkspaceChannel $channel) {
            $channel->created_by_id = optional(auth()->user())->id;
        });
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'channel_user', 'user_id', 'channel_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'channel_id');
    }
}
