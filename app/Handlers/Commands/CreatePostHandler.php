<?php namespace Twitter\Handlers\Commands;

use Illuminate\Contracts\Events\Dispatcher;
use Twitter\Commands\CreatePost;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Events\UserPosted;
use Twitter\Factories\PostFactory;

class CreatePostHandler {

	protected $postFactory, $eventDispatcher;

	public function __construct(PostFactory $postFactory, Dispatcher $eventDispatcher)
	{
		$this->postFactory = $postFactory;
		$this->eventDispatcher = $eventDispatcher;
	}

	/**
	 * Handle the command.
	 *
	 * @param  CreatePost  $command
	 * @return void
	 */
	public function handle(CreatePost $command)
	{
		$this->postFactory->create($command->user->id, $command->postString);

		$this->eventDispatcher->fire(
			new UserPosted($command->user, $command->postString)
		);
	}

}
