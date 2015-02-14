<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/14/15
 * Time: 4:40 PM
 */

namespace Twitter\Repositories;


use Twitter\Favorite;

class FavoriteRepository {

    protected $favorite;

    public function __construct(Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

    public function remove($userId, $postId)
    {
        return $this->favorite->where(['user_id' => $userId, 'post_id' => $postId])->delete();
    }
}