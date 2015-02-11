<?php namespace Twitter\Handlers\Events;

use Illuminate\Translation\Translator;
use Symfony\Component\Security\Core\User\User;
use Twitter\Events\UserSubscribed;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Factories\AlertFactory;

class UserSubscribedHandler {

	protected $alertFactory;
	protected $translator;

	public function __construct(AlertFactory $alertFactory, Translator $translator)
	{
		$this->alertFactory = $alertFactory;
		$this->translator = $translator;
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserSubscribed  $event
	 * @return void
	 */
	public function handle(UserSubscribed $event)
	{
        $this->alertFactory->create(
            $event->followId,
            $this->translator->get(
                'alerts.new-follower', ['name' => $event->userName]
            )
        );
	}

}
