<?php namespace Twitter\Http\Requests;

use Illuminate\Contracts\Auth\Guard;
use Twitter\Http\Requests\Request;

class UnFavoriteRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(Guard $auth)
	{
		$me = $auth->user();

		if ( ! $me->favorited($this->post_id))
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
