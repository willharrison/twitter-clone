<?php namespace Twitter\Handlers\Events;

use Illuminate\Log\Writer;
use Illuminate\Translation\Translator;
use Twitter\Events\UserPosted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Exceptions\UserNotFoundException;
use Twitter\Factories\AlertFactory;
use Twitter\Repositories\UserRepository;
use Twitter\Services\PostParser;

class UserMentionedHandler {

	protected $alertFactory;
	protected $translator;
	protected $parser;
	protected $logger;
	protected $userRepo;

	public function __construct(
		AlertFactory $alertFactory,
		Translator $translator,
		PostParser $parser,
		Writer $logger,
		UserRepository $userRepo)
	{
		$this->alertFactory = $alertFactory;
		$this->translator = $translator;
		$this->parser = $parser;
		$this->logger = $logger;
		$this->userRepo = $userRepo;
	}

	public function handle(UserPosted $event)
	{
		$by = $event->user->name;
		$mentions = $this->parser->mentionsIn($event->postString);

		foreach ($mentions as $mention)
		{
			$this->alert($mention, $by);
		}
	}

	// TODO: this exception functionality can be moved to the repo
	private function alert($user, $name)
	{
		try
		{
			$user = $this->userRepo->findByName($user);

			if ($user->name != $name)
			{
				$this->alertFactory->create(
					$user->id,
					$this->translator->get(
						'alerts.mentioned-in-post', ['name' => $name]
					)
				);
			}
		}
		catch (\ErrorException $e)
		{
			$this->logger->info(
				'Invalid user was mentioned',
				['message' => $e->getMessage()]
			);
		}
	}

}
