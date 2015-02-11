<?php namespace Twitter\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Twitter\Commands\AddPostToFavorites;
use Twitter\Commands\CreatePost;
use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Twitter\User;

class PostController extends Controller {

    use DispatchesCommands;

    protected $auth, $me;

    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;
        $this->me = $auth->user();
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
            $post
        ));

        return redirect('home');
    }

    public function postFavorite(Request $request)
    {
        $postId = $request->only('post_id')['post_id'];

        $this->dispatch(new AddPostToFavorites(
            $this->me,
            $postId
        ));

        return redirect('home');
    }
}
