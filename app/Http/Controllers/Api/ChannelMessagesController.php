<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessage;
use App\Models\WorkspaceChannel;
use App\Repositories\MessageRepository;

class ChannelMessagesController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $repository)
    {
        $this->messageRepository = $repository;
    }

    public function store(StoreMessage $request, WorkspaceChannel $channel)
    {
        $request->merge(['channel_id' => $channel->id]);
        $message = $this->messageRepository->store($request->all());
        broadcast(new MessageCreated($channel, $message))->toOthers();

        return response()->json($message);
    }
}
