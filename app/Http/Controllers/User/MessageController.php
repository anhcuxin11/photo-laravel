<?php

namespace App\Http\Controllers\User;

use App\Events\MessagePublished;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Transformers\SuccessResource;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class MessageController extends Controller
{
    /**
     * Request request
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'email', 'description']);

        $message = Message::create($data);
        event (new MessagePublished($message->name, $message->email));

        return SuccessResource::make(null, 201);
    }

    public function location(Request $request)
    {
        // $ip = $request->ip();
        // dd($ip);
        $ip = '171.244.216.76';
        $currentUserInfo = location::get($ip);

        return response()->json(['data' => $currentUserInfo]);
    }
}
