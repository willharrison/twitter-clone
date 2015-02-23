<?php namespace Twitter\Http\Requests;

use Illuminate\Contracts\Auth\Guard;
use Twitter\Repositories\UserRepository;

class MessageRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(Guard $auth, UserRepository $repo)
	{
        $user = $repo->findByName($this->to);

        if (!is_null($user) && $user->follows($auth->user()->id))
        {
            return true;
        }

		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'to' => 'required',
            'message' => 'required|max:140'
		];
	}

}
