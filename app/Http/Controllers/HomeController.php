<?php namespace Twitter\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Twitter\Repositories\PostRepository;
use Twitter\Services\PostsGetter;
use Twitter\Services\Trending;

class HomeController extends Controller {

    protected $getter, $me, $repo;

	public function __construct(
        Guard $auth,
        PostsGetter $getter,
        PostRepository $repo)
	{
		$this->middleware('auth');
        $this->me = $auth->user();
        $this->getter = $getter;
        $this->repo = $repo;
	}

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

    public function search(Request $request)
    {
        $query = $request->q;
        $results = $this->repo->search($query);
        return view('search.show')
            ->withQuery($query)
            ->withPosts($results);
    }
}
