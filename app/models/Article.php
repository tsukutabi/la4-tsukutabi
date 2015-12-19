<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Article extends Model{
    use SoftDeletingTrait;
    /**
     * モデルで使用されるデータベース
     *
     * @var string
     */
    protected $guarded = ['id'];
    protected $fillable = ['title','subtitle','photos','user_id'/*,'photo_comments','latitude','longitude'*/,'days','night'];
    protected $hidden = ['users.email'];
    public $timestamps = true;

//    public function __construct (FileUtils $fileUtils)
//    {
//        $this->file_utility = $fileUtils;
//    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
//todo 例外処理
    public function get_index_data(){
        return DB::table('articles')
                    ->select('users.username','users.facephoto','articles.user_id','articles.title','articles.id','photos','subtitle')
                    ->leftJoin('users', 'users.id', '=', 'articles.user_id')
                    ->get();
    }

    public function fetch_view_data($id)
    {
        try{
            $result['articles'] = DB::table('articles')
            ->select('users.username','articles.user_id','articles.id','title','subtitle','photos','photo_comments','view')
            ->where('articles.id','=',$id)
            ->leftJoin('users','users.id', '=', 'articles.user_id')
            ->first();

            $result['comment_data'] = DB::table('comments')
            ->select('users.username','users.id','users.facephoto','comments.user_id','comments.id','comments.comment','comments.created_at')
            ->where('comments.article_id','=',$id)
            ->leftJoin('users','users.id', '=', 'comments.user_id')
            ->get();

            $result['fav_data'] = DB::table('favs')
            ->select()
            ->where('article_id','=',$id)
            ->get();

            $result['fav_num'] = DB::table('favs')
            ->where('article_id','=',$id)
            ->count();

            DB::table('users')->count();

        }catch (Exception $e){
            Log::info($e);
            return Response::json(['message'=>'データベースエラー'],'500');
        }
        Log::debug($result);
        $result['photos'] = explode('+',$result['articles']->photos);
        return  $result;
    }

//    記事のアップロード処理
    public function save_article($input){
//        $messages = ['messages'=>'','num'=>''];
        $photo_name_array = [];
        $set_path = public_path('images/'.$input['user_id']);
        if(!File::exists($set_path))
        {
            File::makeDirectory($set_path);
        }
 //        関数化
        foreach ($input['photos'] as $photo_data ){
            $photo_exif_ary[] = exif_read_data( $photo_data );
            $mime = $photo_data->getClientOriginalExtension();
            $name = md5(sha1(uniqid(mt_rand(0,40000), true))).'.'.$mime;
            if($photo_data->move($set_path, $name)){
                array_push($photo_name_array,$name);
            }
//            exifの削除
        }
//        ここまで
        Log::info($photo_exif_ary);
//        todo 例外処理
        $article = new Article();
            $article->title = $input['MainTitle'];
            $article->subtitle = $input['SubTitle'];
            $article->photos = implode('+',$photo_name_array);;
    //        $article->photo_comments = implode('+',$input['comments']);
            $article->user_id = $input['user_id'];
    //        $article->latitude = $latude;
    //        $article->latitude = $latude;
            $article->departure_at = $input['departure_at'];
            $article->return_at = $input['return_at'];
        $article->save();
        return Response::json('ok');
    }



    /********************************************************

    Exifデータの位置情報を60進数から10進数に変換する関数
    第1引数:進行方向(["GPSLatitudeRef"]、["GPSLongitudeRef"])
    第2引数:60進数の配列(["GPSLatitude"]、["GPSLongitude"])
    返り値:10進数に直したデータ

     ********************************************************/

    private  function get_10_from_60_exif( $ref , $gps )
    {
        // 60進数から10進数に変換
        $data = convert_float( $gps[0] ) + ( convert_float($gps[1])/60 ) + ( convert_float($gps[2])/3600 ) ;
        //南緯、または西経の場合はマイナスにして返却
        return ( $ref=='S' || $ref=='W' ) ? ( $data * -1 ) : $data ;
    }

// [例:986/100]という文字列を[986÷100=9.86]というように数値に変換する関数
    private  function convert_float($str)
    {
        $val = explode( '/' , $str ) ;
        return ( isset($val[1]) ) ? $val[0] / $val[1] : $str ;
    }


    public function count_views($id){
        try{
            $count_num = Article::find($id);
            $count_num->view++;
            Log::debug($count_num);
            $count_num->save();
        }catch(Exception $e){
            Log::info($e);
            return "データベースエラー";
        }
        return $count_num->view;
    }

}
