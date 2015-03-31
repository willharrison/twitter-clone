<?php namespace Twitter\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Twitter\Services\PostsGetter;
use Twitter\Services\Trending;

class HomeController extends Controller {

    protected $getter, $me;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Guard $auth, PostsGetter $getter)
	{
		$this->middleware('auth');
        $this->me = $auth->user();
        $this->getter = $getter;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(
        Request $request,
        Trending $trending,
        PostsGetter $getter)
	{
        $postCount = count($this->getter->getAll($request->user()->id));
		return view('home')
            ->withTrending($trending->get(5, 100))
            ->withPosts($getter->followingPost($request->user()->id))
            ->with('postCount', $postCount);
	}

    public function notifications()
    {
        $alerts = $this->me->unread_alerts;
        return view('alerts.show')
            ->withAlerts($alerts);
    }

}
