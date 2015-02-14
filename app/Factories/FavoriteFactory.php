<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/9/15
 * Time: 11:14 AM
 */

namespace Twitter\Factories;


use Twitter\Favorite;
use Twitter\User;

class FavoriteFactory {

    protected $favorite;

    public function __construct(Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

    public function create($userId, $postId)
    {
        $this->favorite->create([
            'user_id' => $userId,
            'post_id' => $postId
        ]);
    }
}