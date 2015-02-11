<?php namespace Twitter\Handlers\Commands;

use Illuminate\Contracts\Events\Dispatcher;
use Twitter\Commands\CreateRePost;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Factories\RePostFactory;

class CreateRePostHandler {

	protected $factory, $dispatcher;

	public function __construct(RePostFactory $factory, Dispatcher $dispatcher)
	{
		$this->factory = $factory;
		$this->dispatcher = $dispatcher;
	}

	/**
	 * Handle the command.
	 *
	 * @param  CreateRePost  $command
	 * @return void
	 */
	public function handle(CreateRePost $command)
	{
		$this->factory->create($command->userId, $command->postId);
	}

}
