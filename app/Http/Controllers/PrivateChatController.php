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

        // Get all conversations for the sidebar
        $conversations = $this->messageService->getUserConversations(Auth::id());

        return view('private-chat', [
            'recipient' => $chatData['receiver'],
            'privateMessages' => $chatData['messages'],
            'conversations' => $conversations
        ]);
    }

    public function send(Request $request, User $user)
    {
        \Log::info('PrivateChatController::send called', [
            'has_message' => !empty($request->message),
            'has_image' => $request->hasFile('image'),
            'message_content' => $request->message,
            'image_file' => $request->hasFile('image') ? $request->file('image')->getClientOriginalName() : null
        ]);

        $request->validate([
            'message' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240' // 10MB max
        ]);

        // Check if at least one of message or image is provided
        if (empty($request->message) && !$request->hasFile('image')) {
            \Log::warning('No message or image provided');
            return response()->json(['error' => 'Message or image is required.'], 400);
        }

        $result = $this->messageService->sendPrivateMessage(
            Auth::id(), 
            $user->id, 
            $request->message,
            $request->file('image')
        );

        if (isset($result['error'])) {
            \Log::error('MessageService error', ['error' => $result['error']]);
            return response()->json(['error' => $result['error']], 400);
        }

        \Log::info('Message sent successfully', ['message_id' => $result['message']->id]);
        return response()->json(['message' => $result['message']]);
    }
}
