<?php namespace App\Repositories;

use App\Models\Message;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class MessageRepository extends Repository
{
    /**
     * UserRepository constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        parent::__construct($message);
    }
}