<?php namespace Twitter\Events;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Database\Eloquent\Model;
use Twitter\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserSubscribed extends Event implements ShouldBeQueued {

	use SerializesModels;

	public $userName, $followId;

	public function __construct(Model $user, $followId)
	{
		$this->userName = $user->name;
		$this->followId = $followId;
	}

}
