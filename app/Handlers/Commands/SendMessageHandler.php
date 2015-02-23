<?php namespace Twitter\Handlers\Commands;

use Illuminate\Contracts\Events\Dispatcher;
use Twitter\Commands\SendMessage;

use Illuminate\Queue\InteractsWithQueue;
use Twitter\Events\MessageSent;
use Twitter\Factories\MessageFactory;
use Twitter\Repositories\UserRepository;

class SendMessageHandler {

    protected $factory, $dispatcher, $repo;

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(
        MessageFactory $factory,
        Dispatcher $dispatcher,
        UserRepository $repo)
	{
        $this->factory = $factory;
        $this->dispatcher = $dispatcher;
        $this->repo = $repo;
	}

	/**
	 * Handle the command.
	 *
	 * @param  SendMessage  $command
	 * @return void
	 */
	public function handle(SendMessage $command)
	{
        $toId = $this->repo->findByName($command->to)->id;
        $fromName = $this->repo->find($command->from)->name;
        $messageId = $this->factory->create($command->from, $toId, $command->message);

        $this->dispatcher->fire(new MessageSent(
            $fromName,
            $toId,
            $messageId
        ));
	}

}
