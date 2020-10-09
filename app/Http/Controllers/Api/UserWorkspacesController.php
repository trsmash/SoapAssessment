<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkspace;
use App\Models\User;
use App\Repositories\WorkspaceRepository;

class UserWorkspacesController extends Controller
{
    protected $workspaceRepository;
    protected $channelRepository;

    public function __construct(WorkspaceRepository $workspaceRepository)
    {
        $this->workspaceRepository  = $workspaceRepository;
    }

    public function index(User $user)
    {
        return response()->json($user->workspaces);
    }

    public function store(StoreWorkspace $request, User $user)
    {
        $workspace = $this->workspaceRepository->store($request->all());
        $workspace->users()->sync([$user->id]);

        return response()->json($workspace);
    }
}
