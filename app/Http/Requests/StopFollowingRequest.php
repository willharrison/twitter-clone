<?php namespace Twitter\Http\Requests;

use Illuminate\Contracts\Auth\Guard;
use Twitter\Http\Requests\Request;

class StopFollowingRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(Guard $auth)
	{
		$me = $auth->user();
		$followId = $this->follow_id;

		if ($me->id == $followId || ! $me->follows($followId))
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
