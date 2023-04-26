<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function message_send(Request $request)
    {
        $conversation = new Conversation();

        $conversation->title = $request->title;
        $conversation->messages = $request->messages;
        $conversation->product_id = $request->product_id;
        $conversation->sender_id = auth()->user()->id;
        $conversation->recever_id = null;
        $conversation->user_id = auth()->user()->id;

        $conversation->save();

        return redirect()->back()->with('success', 'Message Send successfully ');
    }
    public function conversation($id)
    {

        $conversations = Conversation::with('sender')->where('product_id', $id)->get();
        return Response($conversations);
    }
}
