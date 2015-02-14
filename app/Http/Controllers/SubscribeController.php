<?php namespace Twitter\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Twitter\Commands\MuteUser;
use Twitter\Commands\StopFollowing;
use Twitter\Commands\StopMuting;
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

	public function postFollow(Requests\FollowRequest $request)
	{
		$command = new SubscribeUser(
			$this->auth->user(),
			$request->follow_id
		);

		$this->dispatch($command);

		return redirect('home');
	}

	public function postUnfollow(Requests\StopFollowingRequest $request)
	{
		$command = new StopFollowing(
			$this->auth->user(),
			$request->follow_id
		);

		$this->dispatch($command);

		return redirect('home');
	}

	public function postMute(Requests\MuteRequest $request)
	{
		$command = new MuteUser(
			$this->auth->user()->id,
			$request->mute_id
		);

		$this->dispatch($command);

		return redirect('home');
	}

	public function postUnmute(Requests\StopMutingRequest $request)
	{
		$command = new StopMuting(
			$this->auth->user(),
			$request->mute_id
		);

		$this->dispatch($command);

		return redirect('home');
	}
}
