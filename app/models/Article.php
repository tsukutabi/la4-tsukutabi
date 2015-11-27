<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Database\Eloquent\SoftDeles;

class Article extends Model{
//	use UserTrait, RemindableTrait;
    use SoftDeletingTrait;
    /**
     * モデルで使用されるデータベース
     *
     * @var string
     */
    protected $guarded = ['id'];
    public $timestamps = true;
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    protected $fillable = ['title','subtitle','photos','user_id'/*,'photo_comments','latitude','longitude'*/,'days','night'];
    protected $hidden = ['users.email'];

    public static function get_index_data(){
        $articles = DB::table('articles')
                    ->select('users.username','articles.user_id','articles.title','articles.id','photos','subtitle')
                    ->leftJoin('users', 'users.id', '=', 'articles.user_id')
                    ->get();
        return $articles;
    }

    public static function fetch_view_data($id)
    {
        try{
            $articles = DB::table('articles')
            ->select('users.username','articles.user_id','articles.id','title','subtitle','photos','photo_comments','view')
            ->where('articles.id','=',$id)
            ->leftJoin('users','users.id', '=', 'articles.user_id')
            ->first();

            $result['comment_data'] = DB::table('comments')
            ->select('users.username','users.id','comments.user_id','comments.id','comments.comment','comments.created_at')
            ->where('comments.article_id','=',$id)
            ->leftJoin('users','users.id', '=', 'comments.user_id')
            ->get();

            $result['fav_data'] = DB::table('favs')
            ->select()
            ->where('article_id','=',$id)
            ->get();
            
        }catch (Exception $e){
            Log::info($e);
            return Response::json(['message'=>$e],'500');
        }
        $result['photos'] = explode('+',$articles->photos);
        $result['articles'] = $articles;

        return  $result;
    }

//    記事のアップロード処理
    public static function save_article(array $input,$user_id){
        $messages = ['messages'=>'','num'=>''];
        $photo_name_array = [];
        $set_path = public_path('images/'.$user_id);
        if(!File::exists($set_path))
        {
            File::makeDirectory($set_path);
        }
        $photo = $input['photos'];
        foreach ($photo as $photo_data ){

            $photo_exif_ary[] = exif_read_data( $photo_data );
            $mime = $photo_data->getClientOriginalExtension();
//            if($mime !== 'jpg' and 'png' and 'gif' and 'jpeg'){
//                $messages = ['messages'=>'NG',500];
//                return $messages;
//            }
            $name = md5(sha1(uniqid(mt_rand(0,40000), true))).'.'.$mime;
            if($photo_data->move($set_path, $name)){
                array_push($photo_name_array,$name);
            }
        }
        Log::info($photo_exif_ary);
        $photo_names = implode('+',$photo_name_array);
//      $photo_comments = implode('+',$input['comments']);
        $data['photos'] = $photo_names;

        $article = new Article();
            $article->title = $input['MainTitle'];
            $article->subtitle = $input['SubTitle'];
            $article->photos = $photo_names;
    //        $article->photo_comments = $photo_comments;
            $article->user_id = $input['user_id'];
    //        $article->latitude = $latude;
    //        $article->latitude = $latude;
            $article->departure_at = $input['departure_at'];
            $article->return_at = $input['return_at'];

        if($article->save()) {
            $messages = ['messages' => 'ok',200];
        }else{
            $messages =['message'=>'NG',500];
        }
        return $messages;
    }
//    mimetypeのチェック
    private static function check_mime($mimetype){

    }

//    exif系の処理
    private static function check_exif(){
        $img = $_GET['photo'];

    }

    /********************************************************

    Exifデータの位置情報を60進数から10進数に変換する関数
    第1引数:進行方向(["GPSLatitudeRef"]、["GPSLongitudeRef"])
    第2引数:60進数の配列(["GPSLatitude"]、["GPSLongitude"])
    返り値:10進数に直したデータ

    解説: https://syncer.jp/php-exif-read-data

     ********************************************************/

    private static function get_10_from_60_exif( $ref , $gps )
    {
        // 60進数から10進数に変換
        $data = convert_float( $gps[0] ) + ( convert_float($gps[1])/60 ) + ( convert_float($gps[2])/3600 ) ;
        //南緯、または西経の場合はマイナスにして返却
        return ( $ref=='S' || $ref=='W' ) ? ( $data * -1 ) : $data ;
    }

// [例:986/100]という文字列を[986÷100=9.86]というように数値に変換する関数
    private static function convert_float ($str )
    {
        $val = explode( '/' , $str ) ;
        return ( isset($val[1]) ) ? $val[0] / $val[1] : $str ;
    }


    public static function count_view($id){
//        viewのデータをとってきて
        try{
            $count_num = DB::table('articles')
                ->select('view')
                ->first();
        }catch(Exception $e){
            Log::info($e);
            return "データベースエラー";
        }
//        増やして
        Log::info($count_num);
        $count_num =$count_num+1;
        Log::info($count_num);
//    保存する。
        try{

        }catch (Exception $e ){
            Log::info($e);
            return "データベース接続エラーでした 涙";
        }
        return Response::json(200);
    }




}
