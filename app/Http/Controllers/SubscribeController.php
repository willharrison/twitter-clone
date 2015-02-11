<?php namespace Twitter\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Twitter\Commands\SubscribeUser;
use Twitter\Commands\UserSubscribes;
use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SubscribeController extends Controller {

	use DispatchesCommands;

	private $auth;

	public function __construct(Guard $auth)
	{
		$this->middleware('auth');
		$this->auth = $auth;
	}

	public function postFollow(Request $request)
	{
		$command = new SubscribeUser(
			$this->auth->user(),
			$request->only('follow_id')['follow_id']
		);

		$this->dispatch($command);

		return redirect('home');
	}

}
