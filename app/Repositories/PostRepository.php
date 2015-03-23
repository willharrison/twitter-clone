<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/9/15
 * Time: 11:23 AM
 */

namespace Twitter\Repositories;


use Twitter\Post;

class PostRepository {

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function find($id)
    {
        return $this->post->find($id);
    }

    public function findByUser($id)
    {
        return $this->post->where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function latest()
    {
        return $this->post->orderBy('created_at', 'desc')->firstOrFail();
    }

    public function remove($id)
    {
        return $this->post->find($id)->delete();
    }
}