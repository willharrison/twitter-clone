<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/21/15
 * Time: 2:49 PM
 */

namespace Twitter\Factories;


use Twitter\Profile;
use Twitter\User;

class ProfileFactory {

    protected $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function create(User $user)
    {
        $this->profile->create([
            'user_id' => $user->id
        ]);
    }


}