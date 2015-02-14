<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/8/15
 * Time: 7:13 PM
 */

namespace Twitter\Services;



class PostParser {

    private $mentionMark = "@";
    private $hashtagMark = "#";

    public function mentionsIn($post)
    {
        return $this->parse($post, $this->mentionMark);
    }

    public function hashtagsIn($post)
    {
        return $this->parse($post, $this->hashtagMark);
    }

    private function parse($post, $checkFor)
    {
        $section = explode(' ', $post);
        $list = [];

        foreach ($section as $subsection)
        {
            if ($subsection[0] == $checkFor)
            {
                $list[] = substr($subsection, 1, strlen($subsection));
            }
        }

        return $list;
    }

}