<?php namespace Twitter\Handlers\Commands;

use Illuminate\Contracts\Events\Dispatcher;
use Twitter\Commands\CreateRePost;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Events\UserRePosted;
use Twitter\Factories\RePostFactory;
use Twitter\Repositories\PostRepository;

class CreateRePostHandler {

	protected $factory, $repo, $dispatcher;

	public function __construct(
		RePostFactory $factory,
		PostRepository $repo,
		Dispatcher $dispatcher)
	{
		$this->factory = $factory;
		$this->dispatcher = $dispatcher;
		$this->repo = $repo;
	}

	/**
	 * Handle the command.
	 *
	 * @param  CreateRePost  $command
	 * @return void
	 */
	public function handle(CreateRePost $command)
	{

		$postOwner = $this->repo->find($command->postId)->user;
		$this->factory->create($command->user->id, $command->postId);

		$this->dispatcher->fire(new UserRePosted(
			$command->user, $postOwner->id
		));
	}

}
