<?php namespace Twitter\Handlers\Events;

use Illuminate\Translation\Translator;
use Twitter\Events\UserReplied;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Factories\AlertFactory;
use Twitter\Repositories\PostRepository;
use Twitter\Repositories\UserRepository;

class UserRepliedHandler {

	protected $alertFactory, $translator, $postRepo, $userRepo;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(
		AlertFactory $alertFactory,
		Translator $translator,
		PostRepository $postRepo,
		UserRepository $userRepo)
	{
		$this->alertFactory = $alertFactory;
		$this->translator = $translator;
		$this->postRepo = $postRepo;
		$this->userRepo = $userRepo;
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserReplied  $event
	 * @return void
	 */
	public function handle(UserReplied $event)
	{
		$user = $this->userRepo->find($event->user->id);
		$name = $user->name;
		$alertId = $this->postRepo->find($event->postId)->parent->user->id;

		if ($user->id != $alertId)
		{
			$this->alertFactory->createWithPostId(
				$alertId,
                $event->postId,
				$this->translator->get(
					'alerts.post-has-reply', ['name' => $name]
				)
			);
		}
	}

}
