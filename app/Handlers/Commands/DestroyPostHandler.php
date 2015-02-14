<?php namespace Twitter\Handlers\Commands;

use Twitter\Commands\DestroyPost;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Repositories\PostRepository;

class DestroyPostHandler {

	protected $repo;

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(PostRepository $repo)
	{
		$this->repo = $repo;
	}

	/**
	 * Handle the command.
	 *
	 * @param  DestroyPost  $command
	 * @return void
	 */
	public function handle(DestroyPost $command)
	{
		$this->repo->remove($command->postId);
	}

}
