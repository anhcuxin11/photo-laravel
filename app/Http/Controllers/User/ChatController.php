<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use App\Transformers\ChatResource;
use App\Transformers\ModelResource;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function fetchMessages()
    {
        $chat = Chat::with('user')->get();

        return ChatResource::make($chat);
    }

    public function sendMessage(Request $request, int $id)
    {
        $user = User::find($id);
        $chat = $user->chats()->create([
            'message' => $request->input('message')
        ]);

        return ModelResource::make($chat);
    }
}
