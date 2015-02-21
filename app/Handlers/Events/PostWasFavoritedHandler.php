<?php namespace Twitter\Handlers\Events;

use Illuminate\Translation\Translator;
use Twitter\Events\PostWasFavorited;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Factories\AlertFactory;

class PostWasFavoritedHandler {

	protected $alertFactory, $translator;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(
		AlertFactory $alertFactory,
		Translator $translator
	)
	{
		$this->alertFactory = $alertFactory;
		$this->translator = $translator;
	}

	/**
	 * Handle the event.
	 *
	 * @param  PostWasFavorited  $event
	 * @return void
	 */
	public function handle(PostWasFavorited $event)
	{
		$alertId = $event->post->user->id;
		$favoritedBy = $event->user->name;
		$favoritedById = $event->user->id;

		if ($alertId != $favoritedById)
		{
            $this->alertFactory->createWithPostId(
                $alertId,
                $event->post->id,
                $this->translator->get(
                    'alerts.post-was-favorited', ['name' => $favoritedBy]
                )
            );
		}

	}

}
