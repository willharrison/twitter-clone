<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 2/8/15
 * Time: 7:13 PM
 */

namespace Twitter\Services;



class PostParser {

    public function __construct()
    {
    }

    public function mentionsIn($post)
    {
        $section = explode(' ', $post);
        $list = [];

        foreach ($section as $subsection)
        {
            if ($subsection[0] == '@')
            {
                $list[] = substr($subsection, 1, strlen($subsection));
            }
        }

        return $list;
    }
}