<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/17/15
 * Time: 2:32 PM
 */

namespace Twitter\Repositories;


use Twitter\RePost;

class RePostRepository {

    protected $repost;

    public function __construct(RePost $rePost)
    {
        $this->repost = $rePost;
    }

    public function remove($userId, $postId)
    {
        $this->repost->where(['user_id' => $userId, 'post_id' => $postId])->delete();
    }
}