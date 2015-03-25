<?php namespace Twitter\Http\Controllers;

use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Twitter\Repositories\FavoriteRepository;
use Twitter\Services\PostsGetter;
use Twitter\User;

class UserController extends Controller {

    protected $getter, $favRepo;

    public function __construct(
        PostsGetter $getter,
        FavoriteRepository $favRepo)
    {
        $this->getter = $getter;
        $this->favRepo = $favRepo;
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(User $user)
	{
        $posts = $this->getter->getAllOrdered($user->id);
		return view('users.show', compact('user'))
            ->withPosts($posts)
            ->with('postCount', count($posts));
	}

    public function showFavorites(User $user)
    {
        $postCount = count($this->getter->getAll($user->id));
        $posts = $this->favRepo->findByUser($user->id);
        return view('users.show', compact('user'))
            ->withPosts($posts)
            ->with('postCount', $postCount);
    }

    public function showFollowers(User $user)
    {
        $postCount = count($this->getter->getAll($user->id));
        return view('users.follow')
            ->withUser($user)
            ->withFollow($user->followers)
            ->with('postCount', $postCount);
    }

    public function showFollowing(User $user)
    {
        $postCount = count($this->getter->getAll($user->id));
        return view('users.follow')
            ->withUser($user)
            ->withFollow($user->following)
            ->with('postCount', $postCount);
    }

}
