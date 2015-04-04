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

    public function postToHTML($post)
    {
        $linkUrls = $this->linkUrls($post);
        $mentionsLinked = $this->linkMentions($linkUrls);
        return $this->linkHashtags($mentionsLinked);
    }

    public function linkUrls($post)
    {
        $postArray = explode(' ', $post);
        $newPost = [];

        foreach ($postArray as $section)
        {
            if (filter_var($section, FILTER_VALIDATE_URL))
            {
                $temp = $section;
                if (!preg_match('#^http(s)?://#', $section)) {
                    $section = 'http://' . $section;
                }
                $section = "<a href=\"{$section}\" target=\"_blank\">{$temp}</a>";
            }
            array_push($newPost, $section);
        }

        return implode(' ', $newPost);
    }

    public function linkMentions($post)
    {
        return $this->linkify($post, $this->mentionMark);
    }

    public function linkHashtags($post)
    {
        return $this->linkify($post, $this->hashtagMark, 'hashtag');
    }

    public function linkify($post, $checkFor, $url = '')
    {
        $postArray = explode(' ', $post);
        $newPost = [];
        $url = $url === '' ? $url : '/' .  $url;

        foreach ($postArray as $section)
        {
            $firstLetter = substr($section, 0, 1);
            if ($firstLetter == $checkFor)
            {
                $chop = substr($section, 1, strlen($section));
                $section = "<span class=\"primary-blue\">{$checkFor}</span><a href=\"{$url}/{$chop}\">{$chop}</a>";
            }
            array_push($newPost, $section);
        }

        return implode(' ', $newPost);
    }

    private function parse($post, $checkFor)
    {
        $section = explode(' ', $post);
        $list = [];

        foreach ($section as $subsection)
        {
            $firstLetter = substr($subsection, 0, 1);
            if ($firstLetter == $checkFor)
            {
                $list[] = substr($subsection, 1, strlen($subsection));
            }
        }

        return $list;
    }

}
