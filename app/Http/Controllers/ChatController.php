<?php

namespace App\Http\Controllers;

use App\Events\GreetingSent;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showChat()
    {
        return view('chat.show');
    }

    public function messageReceived(Request $request)
    {
        $rules = [
            'message' => 'required',
        ];

        broadcast(new MessageSent($request->user(), $request->message));

        return response()->json(['status' => 'Message Sent!'], 200);
    }

    public function greetReceived(Request $request)
    {
        $user = User::findOrFail($request->id);

        broadcast(new GreetingSent($user, "{$request->user()->name} greeted you!"));
        broadcast(new GreetingSent($request->user(), "You greeted {$user->name}!"));
        return "Greetings {$user->name} from {$request->user()->name}";
    }
}
