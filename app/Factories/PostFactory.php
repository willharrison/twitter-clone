<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/8/15
 * Time: 5:18 PM
 */

namespace Twitter\Factories;


use Twitter\Post;

class PostFactory {

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function create($owner, $post)
    {
        $post = $this->post->create([
            'user_id' => $owner,
            'post' => $post
        ]);

        return $post->id;
    }

    public function createReply($owner, $post, $parentId)
    {
        $post = $this->post->create([
            'user_id' => $owner,
            'post' => $post,
            'parent_id' => $parentId
        ]);

        return $post->id;
    }

}
