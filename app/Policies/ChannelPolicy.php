<?php

namespace App\Policies;

use App\Models\Workspace;
use App\Models\WorkspaceChannel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ChannelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    /**
     * @param User $user
     * @param WorkspaceChannel $channel
     * @return Response
     */
    public function view(User $user, WorkspaceChannel $channel)
    {
        return $channel->workspace->users->contains($user)
            ? Response::allow()
            : Response::deny('You are not authorized to view the channel.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user, Workspace $workspace)
    {
        return $workspace->users->contains($user)
            ? Response::allow()
            : Response::deny('You are not authorized to create channels on the specified workspace.');
    }

    /**
     * @param User $user
     * @param WorkspaceChannel $channel
     * @param User $invitee
     * @return Response
     */
    public function invite(User $user, WorkspaceChannel $channel, User $invitee)
    {
        return $channel->workspace->users->contains($user) && $channel->workspace->users->contains($invitee)
            ? Response::allow()
            : Response::deny('You are not authorized to invite users to this channel or the invited user is not authorized on this channel.');
    }
}
