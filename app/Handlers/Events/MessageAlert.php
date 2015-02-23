<?php namespace Twitter\Handlers\Events;

use Illuminate\Translation\Translator;
use Twitter\Events\MessageSent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Factories\MessageAlertFactory;

class MessageAlert {

    protected $factory, $translator;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(MessageAlertFactory $factory, Translator $translator)
	{
        $this->factory = $factory;
        $this->translator = $translator;
	}

	/**
	 * Handle the event.
	 *
	 * @param  MessageSent  $event
	 * @return void
	 */
	public function handle(MessageSent $event)
	{
        $this->factory->create(
            $event->to,
            $this->translator->get('alerts.new-message', ['name' => $event->from]),
            $event->message
        );
	}

}
