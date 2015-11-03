<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
	protected $guarded = [ 'id' ];
	protected $hidden = ['password'];
	protected $softDelete = true;

	public function comments() {
		return $this->hasMany(Comment::class);
	}

	public function articles() {
		return $this->hasMany(Article::class);
	}

	public function setPasswordAttribute( $value )
	{
		$this->attributes['password'] = Hash::make( $value );
	}

	public function confirm()
	{
		return $this->hasOne( 'Confirm' );
	}

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken( $value )
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function getReminderEmail()
	{
		return $this->email;
	}

	public static function get_user_content($user_id)
	{
		return DB::table('articles')
			->select('id','title','subtitle')
			->where('user_id','=',$user_id)
			->get();
	}
	public static function fetch_favs($user_id)
	{
		return DB::table('favs')
		->select('favs.user_id','favs.article_id','articles.id','articles.title')
		->where('favs.user_id','=',$user_id)
		->leftJoin('articles','articles.id','=','favs.article_id')
		->get();
	}

}














