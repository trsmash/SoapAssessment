<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WorkspaceChannel;
use App\Repositories\WorkspaceChannelRepository;

class UserChannelsController extends Controller
{
    protected $channelRepository;

    public function __construct(WorkspaceChannelRepository $channelRepository)
    {
        $this->channelRepository    = $channelRepository;
    }

    public function invite(WorkspaceChannel $channel, User $user)
    {
        $this->authorize('invite', [WorkspaceChannel::class, $channel, $user]);
        $user->channels()->attach($channel);

        return response()->json('User added to channel');
    }
}
