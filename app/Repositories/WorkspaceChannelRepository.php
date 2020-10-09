<?php namespace App\Repositories;

use App\Models\WorkspaceChannel;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class WorkspaceChannelRepository extends Repository
{
    /**
     * UserRepository constructor.
     * @param WorkspaceChannel $channel
     */
    public function __construct(WorkspaceChannel $channel)
    {
        parent::__construct($channel);
    }
}