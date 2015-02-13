<?php namespace Twitter\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Twitter\Commands\AddPostToFavorites;
use Twitter\Commands\CreatePost;
use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Twitter\Repositories\PostRepository;
use Twitter\User;

class PostController extends Controller {

    use DispatchesCommands;

    protected $auth, $me, $repo;

    public function __construct(Guard $auth, PostRepository $repo)
    {
        $this->middleware('auth');
        $this->me = $auth->user();
        $this->auth = $auth;
        $this->repo = $repo;
    }

    public function getShow(User $user, $id)
    {
        $post = $user->posts()->find($id);

        return view('status.show')
            ->withMe($this->me)
            ->withPost($post)
            ->withUser($user);
    }

    public function postCreate(Request $request)
    {
        $post = $request->only('post')['post'];

        $this->dispatch(new CreatePost(
            $this->me,
            $request
        ));

        return redirect('home');
    }

    public function postFavorite(Request $request)
    {
        $postId = $request->only('post_id')['post_id'];
        $post = $this->repo->find($postId);

        $this->dispatch(new AddPostToFavorites(
            $this->me,
            $post
        ));

        return redirect('home');
    }
}
