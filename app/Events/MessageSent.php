<?php namespace Twitter\Events;

use Twitter\Events\Event;

use Illuminate\Queue\SerializesModels;

class MessageSent extends Event {

	use SerializesModels;

    public $from, $to, $message;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($from, $to, $message)
	{
        $this->from = $from;
        $this->to = $to;
        $this->message = $message;
	}

}
