<?php namespace Twitter\Handlers\Events;

use Illuminate\Translation\Translator;
use Twitter\Events\UserRePosted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Factories\AlertFactory;

class UserRePostedHandler {

	protected $factory, $tanslator;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(AlertFactory $factory, Translator $translator)
	{
		$this->factory = $factory;
		$this->translator = $translator;
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserRePosted  $event
	 * @return void
	 */
	public function handle(UserRePosted $event)
	{
		$this->factory->createWithPostId(
			$event->postOwnerId,
            $event->postId,
			$this->translator->get(
				'alerts.post-was-reposted', ['name' => $event->user->name]
			)
		);
	}

}
