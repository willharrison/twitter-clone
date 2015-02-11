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
        $this->post = new Post;
        $this->post->user_id = $owner;
        $this->post->post = $post;
        $this->post->save();
    }
}