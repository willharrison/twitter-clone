<?php namespace Twitter;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function settings()
	{
		return $this->hasOne('Twitter\Settings');
	}

	public function posts()
	{
		return $this->hasMany('Twitter\Post');
	}

	public function reposts()
	{
		return $this->hasMany('Twitter\RePost');
	}

	public function favorites()
	{
		return $this->hasMany('Twitter\Favorite');
	}

	public function alerts()
	{
		return $this->hasMany('Twitter\Alert');
	}

	public function followers()
	{
		return $this->belongsToMany('Twitter\User', 'user_relations', 'followed_id', 'follower_id');
	}

	public function following()
	{
		return $this->belongsToMany('Twitter\User', 'user_relations', 'follower_id', 'followed_id');
	}

}
