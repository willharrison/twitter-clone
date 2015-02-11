<?php namespace Twitter\Handlers\Commands;

use Illuminate\Contracts\Events\Dispatcher;
use Twitter\Commands\AddPostToFavorites;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Events\PostWasFavorited;
use Twitter\Factories\FavoriteFactory;
use Twitter\Repositories\PostRepository;

class AddPostToFavoritesHandler {

	protected $factory, $dispatcher, $repo;

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(
		FavoriteFactory $factory,
		Dispatcher $dispatcher,
		PostRepository $repo)
	{
		$this->factory = $factory;
		$this->dispatcher = $dispatcher;
		$this->repo = $repo;
	}

	/**
	 * Handle the command.
	 *
	 * @param  AddPostToFavorites  $command
	 * @return void
	 */
	public function handle(AddPostToFavorites $command)
	{
		$post = $this->repo->find($command->postId);
		$this->factory->create($command->user->id, $command->postId);

		$this->dispatcher->fire(
			new PostWasFavorited($command->user, $post)
		);
	}

}
