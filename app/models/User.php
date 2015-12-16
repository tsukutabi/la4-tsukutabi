<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
	protected $guarded = [ 'id' ];

    protected $hidden = ['password','token'];
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

	public function create_user($inputs){
		// トランザクションの開始、usersテーブルと、紐ついたconfirmsテーブルを
		// 同時に更新するため。
		// また、エラー発生時に500にするため、DB::transaction()を使用していない。
		DB::beginTransaction();
		try
		{
			$user = User::create( $inputs );
			// Str::random()の実装は調べていない。
			// 乱数生成のアルゴリズムに問題がないか、要チェック
			$confirmKey = Str::random( 32 );

			$user->confirm()->create( ['key' => $confirmKey ] );
			Log::info($user);

		}
		catch( Exception $e )
		{
			DB::rollBack();

			return App::abort( '500', 'データベースが不調です。確認キーの生成に失敗しました。' );
		}
		DB::commit();

        return $confirmKey;

	}

	public function get_user_content($user_id)
	{
		return DB::table('articles')
			->select('id','title','subtitle','created_at')
			->where('user_id','=',$user_id)
			->get();
	}
	public  function fetch_favs($user_id)
	{
		return DB::table('favs')
		->select('favs.user_id','favs.article_id','articles.id','articles.title')
		->where('favs.user_id','=',$user_id)
		->leftJoin('articles','articles.id','=','favs.article_id')
		->get();
	}
	public function fetch_user_data($user_id)
	{
		return DB::table('users')
				->select('username','id','facephoto','profile')
				->where('users.id','=',$user_id)
				->first();
	}

	public function remove_another_mime($mime){
        Log::debug($mime);
        if($mime === 'jpeg' ){
            return false;
        }elseif($mime === 'png'){
            return false;
        }elseif($mime === 'gif'){
            return false;
        }elseif($mime === 'jpg'){

        }else{
            Log::info("true");
            return true;
        }
    }

    public function update_facephoto($inputs,$name){
        try{
            $user = User::find($inputs['user_id']);
            $user->facephoto = $name;
            $user->save();
        }catch (Exception $e){
            Log::debug($e);
            return 500;
        }
        return 200;

    }
}














