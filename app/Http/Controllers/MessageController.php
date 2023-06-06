<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Enquiry;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    public function message_search(Request $request, $id)
    {
        $conversations = Conversation::with('sender')
            ->where(function ($query) use ($request, $id) {
                $query->where('messages', 'LIKE', '%' . $request->searchText . '%')
                    ->orWhere('title', 'LIKE', '%' . $request->searchText . '%');
            })
            ->where('product_id', $id)
            ->get();

        return Response($conversations);
    }
    public function new_enquiry()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        // $users = User::all();
        $users = User::where('id', '!=', auth()->user()->id)->where('id', '!=', 1)->get();

        return view('new_enquiry', compact('roles', 'users'));
    }
    public function enquiry_send(Request $request)
    {
        $enquiry = new Enquiry();
        $createdAt = Carbon::parse($enquiry->created_at)->setTimezone('Asia/Kolkata');
        $formattedCreatedAt = $createdAt->format('Y-m-d H:i:s');
        $enquiry->title = $request->title;
        $enquiry->messages = $request->messages;
        $enquiry->sender_id = auth()->user()->id;
        $enquiry->receiver_id = $request->receiver_id;
        $enquiry->user_id = auth()->user()->id;
        $enquiry->created_at = $formattedCreatedAt;

        $enquiry->save();

        return redirect()->back()->with('success', 'Message Send successfully ');
    }
    public function enquiry($receiverId)
    {
        $messages = Enquiry::all();
        // $messages = Enquiry::where(function ($query) use ($receiverId) {
        //     $query->where('sender_id', auth()->user()->id)
        //         ->where('receiver_id', $receiverId);
        // })->orWhere(function ($query) use ($receiverId) {
        //     $query->where('sender_id', $receiverId)
        //         ->where('receiver_id', auth()->user()->id);
        // })->get();
        // DD($messages);
        return Response($messages);
        // return redirect()->back()->with('success', 'Message Send successfully ');
    }
    public function enquiry_search(Request $request, $id)
    {
        $messages = Enquiry::with('sender')
            ->where(function ($query) use ($request, $id) {
                $query->where('messages', 'LIKE', '%' . $request->searchText . '%')
                    ->orWhere('title', 'LIKE', '%' . $request->searchText . '%');
            })
            ->where('user_id', auth()->user()->id)
            ->get();

        return Response($messages);
    }

    public function chat_show($receiverId)
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->first();
        // $users = User::all();
        $users = User::where('id', '!=', auth()->user()->id)->where('id', '!=', 1)->get();
        $receiver = User::findOrFail($receiverId);
        $messages = Enquiry::where(function ($query) use ($receiverId) {
            $query->where('sender_id', auth()->user()->id)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', auth()->user()->id);
        })->get();
        $lastMes = Enquiry::whereIn('sender_id', [auth()->user()->id, $receiverId])
            ->whereIn('receiver_id', [auth()->user()->id, $receiverId])
            ->orderBy('created_at', 'desc')
            ->first();

        // return $lastMes;
        foreach ($messages as $message) {

            if ($message->is_seen == 'N' && $message->user_id == $receiverId) {
                // return 123;
                $message->is_seen = 'Y';
                $message->save();
            }
            // return $message->is_seen;
        }
        return view('new_enquiry', compact('receiver', 'messages', 'roles', 'users', 'lastMes'));
    }
}