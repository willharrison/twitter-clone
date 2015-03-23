<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/14/15
 * Time: 4:40 PM
 */

namespace Twitter\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Twitter\Favorite;

class FavoriteRepository {

    protected $favorite, $collection;

    public function __construct(
        Favorite $favorite,
        Collection $collection)
    {
        $this->favorite = $favorite;
        $this->collection = $collection;
    }

    public function findByUser($id)
    {
        $posts = [];
        $favorites = $this->favorite->where('user_id', $id)
            ->orderBy('created_at')
            ->get();

        foreach ($favorites as $current)
        {
            $post = $current->post;
            array_push($posts, $post);
        }

        return $this->collection->make($posts);
    }

    public function remove($userId, $postId)
    {
        return $this->favorite->where(['user_id' => $userId, 'post_id' => $postId])->delete();
    }
}