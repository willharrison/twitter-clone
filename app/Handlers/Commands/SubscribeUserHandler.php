<?php namespace Twitter\Handlers\Commands;

use Illuminate\Contracts\Events\Dispatcher;
use Twitter\Commands\SubscribeUser;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Events\UserSubscribed;
use Twitter\Repositories\UserRepository;

class SubscribeUserHandler {

	private $eventDispatcher;

	public function __construct(Dispatcher $eventDispatcher)
	{
		$this->eventDispatcher = $eventDispatcher;
	}

	/**
	 * Handle the command.
	 *
	 * @param  SubscribeUser  $command
	 * @return void
	 */
	public function handle(SubscribeUser $command)
	{
		$user = $command->user;
		$user->following()->attach($command->followId);

		$this->eventDispatcher->fire(new UserSubscribed(
			$user,
			$command->followId
		));
	}
}
