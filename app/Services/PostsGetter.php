<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 3/21/15
 * Time: 11:20 AM
 */

namespace Twitter\Services;


use Twitter\Repositories\PostRepository;
use Twitter\Repositories\RePostRepository;
use Twitter\Repositories\UserRepository;

class PostsGetter {

    private $post, $repost, $user;

    public function __construct(
        UserRepository $user,
        PostRepository $post,
        RePostRepository $repost)
    {
        $this->user = $user;
        $this->post = $post;
        $this->repost = $repost;
    }

    public function getAll($userId)
    {
        $posts = $this->post->findByUser($userId);
        $reposts = $this->repost->findByUser($userId);
        $merge = $posts->merge($reposts);
        return $merge;
    }

    public function getAllOrdered($userId)
    {
        $all = $this->getAll($userId);
        $all->sort(function($a, $b)
        {
            $a = $a->created_at;
            $b = $b->created_at;

            if ($a === $b) {
                return 0;
            }

            return ($a < $b) ? 1 : -1;
        });

        return $all;
    }

    public function followingPost($userId)
    {
        $following = $this->user->find($userId)->following;
        $posts = $this->post->findByUser($userId);

        foreach ($following as $user)
        {
            $followedPosts = $this->post->findByUser($user->id);
            $posts = $posts->merge($followedPosts);
        }

        return $posts;
    }
}