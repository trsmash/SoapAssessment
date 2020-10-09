<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'channel_id',
        'text'
    ];

    protected static function booted()
    {
        static::creating(function (Message $message) {
            $message->sent_by_id = optional(auth()->user())->id;
        });
    }

    public function channel()
    {
        return $this->belongsTo(WorkspaceChannel::class);
    }

    public function sentBy()
    {
        return $this->belongsTo(User::class, 'sent_by_id');
    }
}
