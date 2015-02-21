<?php namespace Twitter\Handlers\Commands;

use Illuminate\Contracts\Events\Dispatcher;
use Twitter\Commands\ReplyToPost;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Events\UserReplied;
use Twitter\Factories\PostFactory;
use Twitter\Repositories\PostRepository;

class ReplyToPostHandler {

	protected $factory, $dispatcher;

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(
		PostFactory $factory,
		Dispatcher $dispatcher)
	{
		$this->factory = $factory;
		$this->dispatcher = $dispatcher;
	}

	/**
	 * Handle the command.
	 *
	 * @param  ReplyToPost  $command
	 * @return void
	 */
	public function handle(ReplyToPost $command)
	{
		$postId = $this->factory->createReply(
			$command->user->id,
			$command->postString,
			$command->replyTo
		);

		$this->dispatcher->fire(new UserReplied(
			$command->user,
            $command->postString,
            $postId
		));
	}

}
