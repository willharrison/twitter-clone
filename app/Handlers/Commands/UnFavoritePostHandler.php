<?php namespace Twitter\Handlers\Commands;

use Twitter\Commands\UnFavoritePost;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Repositories\FavoriteRepository;

class UnFavoritePostHandler {

	protected $repo;

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(FavoriteRepository $repo)
	{
		$this->repo = $repo;
	}

	/**
	 * Handle the command.
	 *
	 * @param  UnFavoritePost  $command
	 * @return void
	 */
	public function handle(UnFavoritePost $command)
	{
		$this->repo->remove($command->userId, $command->postId);
	}

}
