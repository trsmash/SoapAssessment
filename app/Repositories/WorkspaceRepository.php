<?php namespace App\Repositories;

use App\Models\Workspace;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class WorkspaceRepository extends Repository
{
    /**
     * UserRepository constructor.
     * @param Workspace $workspace
     */
    public function __construct(Workspace $workspace)
    {
        parent::__construct($workspace);
    }
}