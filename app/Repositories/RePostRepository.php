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

    protected $repost, $post;

    public function __construct(RePost $rePost, PostRepository $post)
    {
        $this->repost = $rePost;
        $this->post = $post;
    }

    public function findByUser($id)
    {
        $posts = [];
        $reposts = $this->repost->where('user_id', $id)
            ->orderBy('created_at')
            ->get();

        foreach ($reposts as $post)
        {
            $original = $this->post->find($post->post_id);
            $original->isRepost = true;
            $original->created_at = $post->created_at;
            array_push($posts, $original);
        }

        return (object) $posts;
    }

    public function remove($userId, $postId)
    {
        $this->repost->where(['user_id' => $userId, 'post_id' => $postId])->delete();
    }
}