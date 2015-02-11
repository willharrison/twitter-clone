<?php namespace Twitter\Handlers\Events;

use Twitter\Events\UserCreatedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Factories\SettingsFactory;
use Twitter\Settings;
use Twitter\User;

class UserCreatedEventHandler {

	protected $settingsFactory;

	public function __construct(SettingsFactory $settingsFactory)
	{
		$this->settingsFactory = $settingsFactory;
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserCreatedEvent  $event
	 * @return void
	 */
	public function handle(User $user)
	{
		$this->settingsFactory->create($user);
	}

}
