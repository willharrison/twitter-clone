<?php namespace Twitter\Handlers\Commands;

use Twitter\Commands\StopMuting;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Repositories\MuteRepository;

class StopMutingHandler {

	protected $repo;

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(MuteRepository $repo)
	{
		$this->repo = $repo;
	}

	/**
	 * Handle the command.
	 *
	 * @param  StopMuting  $command
	 * @return void
	 */
	public function handle(StopMuting $command)
	{
		$user = $command->user;
		$this->repo->remove($user->id, $command->muteId);
	}

}
