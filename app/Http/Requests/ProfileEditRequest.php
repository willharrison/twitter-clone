<?php namespace Twitter\Http\Requests;

use Twitter\Http\Requests\Request;

class ProfileEditRequest extends Request {

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
            'display_name' => 'max:30',
            'tagline' => 'max:100',
            'location' => 'max:30',
            'website' => 'max:30'
		];
	}

}
