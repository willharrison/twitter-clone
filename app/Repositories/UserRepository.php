<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/8/15
 * Time: 1:37 PM
 */

namespace Twitter\Repositories;


use Twitter\Exceptions\UserNotFoundException;
use Twitter\User;

class UserRepository {

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function findByName($name)
    {
        return $this->user->where('name', $name)->first();
    }
}