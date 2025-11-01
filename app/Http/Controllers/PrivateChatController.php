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

    public function index()
    {
        $conversations = $this->messageService->getUserConversations(Auth::id());

        return view('messages.index', [
            'conversations' => $conversations
        ]);
    }

    public function show(User $user)
    {
        $chatData = $this->messageService->getChatData(Auth::id(), $user->id);

        if (isset($chatData['error'])) {
            abort(403, $chatData['error']);
        }

        $conversations = $this->messageService->getUserConversations(Auth::id());

        return view('private-chat', [
            'recipient' => $chatData['receiver'],
            'privateMessages' => $chatData['messages'],
            'conversations' => $conversations
        ]);
    }

    public function send(Request $request, User $user)
    {
        $request->validate([
            'message' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240' // 10MB max
        ]);

        if (empty($request->message) && !$request->hasFile('image')) {
            return response()->json(['error' => 'Message or image is required.'], 400);
        }

        $result = $this->messageService->sendPrivateMessage(
            Auth::id(),
            $user->id,
            $request->message,
            $request->file('image')
        );

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 400);
        }

        $message = $result['message'];
        $message->image_url = $message->image_path
            ? asset('storage/' . $message->image_path)
            : null;

        return response()->json(['message' => $message]);
    }
}
