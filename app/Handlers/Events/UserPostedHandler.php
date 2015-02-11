<?php namespace Twitter\Handlers\Events;

use Illuminate\Translation\Translator;
use Twitter\Events\UserPosted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Factories\AlertFactory;

class UserPostedHandler {

	protected $alertFactory;
	protected $translator;

	public function __construct(AlertFactory $alertFactory, Translator $translator)
	{
		$this->alertFactory = $alertFactory;
		$this->translator = $translator;
	}

	public function handle(UserPosted $event)
	{
		$name = $event->user->name;
		$followers = $event->user->followers;

		foreach ($followers as $user)
		{
			$this->alertFactory->create(
				$user->id,
				$this->translator->get(
					'alerts.following-posted', ['name' => $name]
				)
			);
		}
	}

}
