<?php namespace Twitter\Http\Controllers;

use Twitter\Http\Requests;
use Twitter\Http\Controllers\Controller;
use Twitter\Http\Requests\SettingsRequest;

use Illuminate\Http\Request;

/**
 * Class SettingsController
 * @package Twitter\Http\Controllers
 */
class SettingsController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $request Request
	 * @return Response
	 */
	public function getEdit(Request $request)
	{
		return view('settings.edit', compact('request'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function postEdit(SettingsRequest $request)
	{
		// ~~~~~~~~~~~~~~~
		//
		// TODO this needs to be moved to a repository
		//
		// ~~~~~~~~~~~~~~~
		$postData = $request->only(['language', 'country']);
		$settings = $request->user()->settings;
		$settings->fill($postData);
		$settings->save();
		return view('settings.edit', compact('request'))->withMessage('success');
	}

}
