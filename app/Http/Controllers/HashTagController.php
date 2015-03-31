<?php namespace Twitter\Http\Controllers;

use Twitter\Hashtag;
use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Twitter\Services\PostsGetter;

class HashTagController extends Controller {

	public function show(Hashtag $hashtag)
	{
        return view('hashtags.show')
            ->withPosts($hashtag->posts)
            ->withHashtag($hashtag->hashtag);
	}


}
