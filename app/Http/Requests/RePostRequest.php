<?php namespace Twitter\Http\Requests;

use Illuminate\Contracts\Auth\Guard;
use Twitter\Http\Requests\Request;
use Twitter\Repositories\PostRepository;

class RePostRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(Guard $auth, PostRepository $repo)
	{
		$me = $auth->user()->id;
		$rePostUserId = $repo->find($this->post_id)->user->id;

		if ($me == $rePostUserId)
		{
			return false;
		}

		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//
		];
	}

}
