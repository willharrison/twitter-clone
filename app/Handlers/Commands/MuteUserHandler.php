<?php namespace Twitter\Handlers\Commands;

use Twitter\Commands\MuteUser;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Factories\MuteFactory;

class MuteUserHandler {

	protected $factory;

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(MuteFactory $factory)
	{
		$this->factory = $factory;
	}

	/**
	 * Handle the command.
	 *
	 * @param  MuteUser  $command
	 * @return void
	 */
	public function handle(MuteUser $command)
	{
		$this->factory->create($command->userId, $command->muteId);
	}

}
