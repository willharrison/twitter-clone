<?php namespace Twitter\Handlers\Events;

use Twitter\Events\UserCreatedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Factories\ProfileFactory;
use Twitter\Factories\SettingsFactory;
use Twitter\Settings;
use Twitter\User;

class UserCreatedEventHandler {

	protected $settingsFactory, $profileFactory;

	public function __construct(
        SettingsFactory $settingsFactory,
        ProfileFactory $profileFactory)
	{
		$this->settingsFactory = $settingsFactory;
        $this->profileFactory = $profileFactory;
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
        $this->profileFactory->create($user);
	}

}
