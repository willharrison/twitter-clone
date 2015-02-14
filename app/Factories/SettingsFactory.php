<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/8/15
 * Time: 1:22 PM
 */

namespace Twitter\Factories;


use Twitter\Settings;
use Twitter\User;

class SettingsFactory {

    protected $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function create(User $user)
    {
        $this->settings->create([
            'user_id' => $user->id
        ]);
    }
}