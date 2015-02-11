<?php namespace Twitter\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'eloquent.created: Twitter\User' => [
			'Twitter\Handlers\Events\UserCreatedEventHandler',
		],
		'Twitter\Events\UserSubscribed' => [
			'Twitter\Handlers\Events\UserSubscribedHandler@handle'
		],
		'Twitter\Events\UserPosted' => [
			'Twitter\Handlers\Events\UserPostedHandler@handle',
			'Twitter\Handlers\Events\UserMentionedHandler@handle'
		],
		'Twitter\Events\PostWasFavorited' => [
			'Twitter\Handlers\Events\PostWasFavoritedHandler@handle'
		]
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
