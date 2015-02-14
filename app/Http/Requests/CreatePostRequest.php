<?php namespace Twitter\Http\Requests;

use Twitter\Http\Requests\Request;

class CreatePostRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
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
			'post' => 'required|max:140'
		];
	}

}
