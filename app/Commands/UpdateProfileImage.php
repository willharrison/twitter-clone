<?php namespace Twitter\Commands;

use Twitter\Commands\Command;
use Twitter\User;

class UpdateProfileImage extends Command {

    public $user, $image;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $image)
	{
        $this->user = $user;
        $this->image = $image;
	}

}
