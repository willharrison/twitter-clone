<?php namespace Twitter\Handlers\Commands;

use Twitter\Commands\DestroyRePost;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Repositories\RePostRepository;

class DestroyRePostHandler {

	protected $repo;

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(RePostRepository $repo)
	{
		$this->repo = $repo;
	}

	/**
	 * Handle the command.
	 *
	 * @param  DestroyRePost  $command
	 * @return void
	 */
	public function handle(DestroyRePost $command)
	{
		$this->repo->remove($command->userId, $command->postId);
	}

}
