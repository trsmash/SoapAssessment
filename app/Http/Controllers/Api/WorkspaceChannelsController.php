<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChannel;
use App\Models\Workspace;
use App\Models\WorkspaceChannel;
use App\Repositories\WorkspaceChannelRepository;

class WorkspaceChannelsController extends Controller
{
    protected $channelRepository;

    public function __construct(WorkspaceChannelRepository $channelRepository)
    {
        $this->channelRepository    = $channelRepository;
    }

    public function index(Workspace $workspace)
    {
        return response()->json($workspace->channels());
    }

    public function store(StoreChannel $request, Workspace $workspace)
    {
        $this->authorize('create', [WorkspaceChannel::class, $workspace]);
        $request->merge(['workspace_id' => $workspace->id]);
        $channel = $this->channelRepository->store($request->all());
        $channel->users()->sync([$request->user()->id]);

        return response()->json($channel);
    }
}
