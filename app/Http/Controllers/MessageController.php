<?php namespace Twitter\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Twitter\Commands\SendMessage;
use Twitter\Factories\MessageFactory;
use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MessageController extends Controller {

    use DispatchesCommands;

    protected $me, $factory;

    public function __construct(Guard $auth, MessageFactory $factory)
    {
        $this->middleware('auth');
        $this->me = $auth->user();
        $this->factory = $factory;
    }

    public function getCreate()
    {
        return view('messages.create');
    }

    public function postCreate(Requests\MessageRequest $request)
    {
        $fromId = $this->me->id;

        $this->dispatch(new SendMessage(
            $request->to,
            $fromId,
            $request->message
        ));

        return redirect('home');
    }
}
