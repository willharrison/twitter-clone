<?php namespace Twitter\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Twitter\Commands\AddPostToFavorites;
use Twitter\Commands\CreatePost;
use Twitter\Commands\DestroyPost;
use Twitter\Commands\ReplyToPost;
use Twitter\Commands\UnFavoritePost;
use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Twitter\Repositories\PostRepository;
use Twitter\Services\PostParser;
use Twitter\User;

class PostController extends Controller {

    use DispatchesCommands;

    protected $auth, $me, $repo, $parser;

    public function __construct(
        Guard $auth,
        PostRepository $repo,
        PostParser $parser)
    {
        $this->middleware('auth');
        $this->me = $auth->user();
        $this->auth = $auth;
        $this->repo = $repo;
        $this->parser = $parser;
    }

    public function getShow(User $user, $id)
    {
        $post = $user->posts()->find($id);

        return view('status.show')
            ->withMe($this->me)
            ->withPost($post)
            ->withUser($user);
    }

    public function postCreate(Requests\CreatePostRequest $request)
    {
        $post = trim($request->post);

        $this->dispatch(new CreatePost(
            $this->me,
            $post
        ));

        $latest = $this->repo->latest();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $latest->id,
                'created' => $latest->created_at->toDateTimeString(),
                'post' => $this->parser->linkify($latest->post, '@')
            ],
            200
        ]);
    }

    public function postReply(Request $request)
    {
        $replyTo = $request->post_id;
        $postString = $request->post;

        $this->dispatch(new ReplyToPost(
            $this->me,
            $replyTo,
            $postString
        ));

        return redirect('home');
    }

    public function postDestroy(Requests\DeletePostRequest $request)
    {
        $postId = $request->post_id;

        $this->dispatch(new DestroyPost(
            $postId
        ));

        return response()->json([
            'success' => true,
            'data' => 'Post removed!',
            200
        ]);
    }

    public function postFavorite(Requests\FavoriteRequest $request)
    {
        $postId = $request->post_id;
        $post = $this->repo->find($postId);

        $this->dispatch(new AddPostToFavorites(
            $this->me,
            $post
        ));

        return response()->json([
            'success' => true,
            'data' => 'Favorite added!',
            200
        ]);
    }

    public function postUnfavorite(Requests\UnFavoriteRequest $request)
    {
        $postId = $request->post_id;
        $userId = $this->me->id;

        $this->dispatch(new UnFavoritePost(
            $userId,
            $postId
        ));

        return response()->json([
            'success' => true,
            'data' => 'Favorite removed!',
            200
        ]);
    }
}
