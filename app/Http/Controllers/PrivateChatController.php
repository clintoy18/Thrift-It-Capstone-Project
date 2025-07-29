<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\MessageService;

class PrivateChatController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function show(User $user)
    {
        $chatData = $this->messageService->getChatData(Auth::id(), $user->id);

        if (isset($chatData['error'])) {
            abort(403, $chatData['error']);
        }

        return view('private-chat', [
            'recipient' => $chatData['receiver'],
            'privateMessages' => $chatData['messages']
        ]);
    }

    public function send(Request $request, User $user)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $result = $this->messageService->sendPrivateMessage(
            Auth::id(), 
            $user->id, 
            $request->message
        );

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 400);
        }

        return response()->json(['message' => $result['message']]);
    }
}
