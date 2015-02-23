<?php namespace Twitter\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Twitter\Commands\UpdateProfileImage;
use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProfileController extends Controller {

    use DispatchesCommands;

    protected $me;

    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->me = $auth->user();
    }

    public function getEdit()
    {
        $profile = $this->me->profile;
        return view('profile.edit', compact('profile'));
    }

    public function postEdit(Requests\ProfileEditRequest $request)
    {
        $profile = $this->me->profile;
        $profile->fill($request->all());
        $profile->save();

        return redirect('home');
    }

    public function getImage()
    {
        return view('profile.image');
    }

    public function postImage(Requests\AddImageRequest $request)
    {
        $this->dispatch(new UpdateProfileImage(
            $this->me,
            $request->file('image')
        ));

        return redirect('home');
    }
}
