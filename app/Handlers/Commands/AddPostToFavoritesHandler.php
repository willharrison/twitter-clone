<?php namespace Twitter\Handlers\Commands;

use Illuminate\Contracts\Events\Dispatcher;
use Twitter\Commands\AddPostToFavorites;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Events\PostWasFavorited;
use Twitter\Factories\FavoriteFactory;
use Twitter\Repositories\PostRepository;

class AddPostToFavoritesHandler {

	protected $factory, $dispatcher;

	public function __construct(
		FavoriteFactory $factory,
		Dispatcher $dispatcher)
	{
		$this->factory = $factory;
		$this->dispatcher = $dispatcher;
	}

	/**
	 * Handle the command.
	 *
	 * @param  AddPostToFavorites  $command
	 * @return void
	 */
	public function handle(AddPostToFavorites $command)
	{
		$this->factory->create($command->user->id, $command->post->id);

		$this->dispatcher->fire(
			new PostWasFavorited($command->user, $command->post)
		);
	}

}
