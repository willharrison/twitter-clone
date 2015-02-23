<?php namespace Twitter\Commands;

use Illuminate\Contracts\Queue\ShouldBeQueued;
use Twitter\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class SendMessage extends Command implements ShouldBeQueued {

    public $to, $from, $message;

    /**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($to, $from, $message)
	{
        $this->to = $to;
        $this->from = $from;
        $this->message = $message;
	}

}
