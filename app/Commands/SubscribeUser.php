<?php namespace Twitter\Commands;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Commands\Command;
use Twitter\User;

class SubscribeUser extends Command implements ShouldBeQueued {

	public $user, $followId;

	public function __construct(User $user, $followId)
	{
		$this->user = $user;
		$this->followId = $followId;
	}

}
