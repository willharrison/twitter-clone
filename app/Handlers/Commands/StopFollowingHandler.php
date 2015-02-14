<?php namespace Twitter\Handlers\Commands;

use Twitter\Commands\StopFollowing;

use Illuminate\Queue\InteractsWithQueue;

class StopFollowingHandler {

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the command.
	 *
	 * @param  StopFollowing  $command
	 * @return void
	 */
	public function handle(StopFollowing $command)
	{
		$user = $command->user;
		$user->following()->detach($command->followId);
	}

}
