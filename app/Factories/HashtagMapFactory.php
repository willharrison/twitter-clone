<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/14/15
 * Time: 10:49 AM
 */

namespace Twitter\Factories;


use Twitter\HashtagMap;

class HashtagMapFactory {

    protected $hashtagMap;

    public function __construct(HashtagMap $hashtagMap)
    {
        $this->hashtagMap = $hashtagMap;
    }

    public function create($hashtagId, $postId)
    {
        $this->hashtagMap->create([
            "hashtag_id" => $hashtagId,
            "post_id" => $postId
        ]);
    }
}