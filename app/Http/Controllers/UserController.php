<?php namespace Twitter\Http\Controllers;

use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Twitter\User;

class UserController extends Controller {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(User $user)
	{
		return view('users.show', compact('user'));
	}

}
