<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use lsolesen\pel;

class Article extends Model{
    use SoftDeletingTrait;
    /**
     * モデルで使用されるデータベース
     *
     * @var string
     */
    protected $guarded = ['id'];
    protected $fillable = ['title','subtitle','photos','main_photo','user_id'/*,'photo_comments'*/,'latitude','longitude','days','night'];
    protected $hidden = ['users.email','users.password'];
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


//todo 例外処理
    public function get_index_data(){
        return DB::table('articles')
                    ->select('users.username','users.facephoto','articles.user_id','articles.title','articles.id','photos','main_photo','subtitle')
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
        $result['photos'] = explode('+',$result['articles']->photos);
        return  $result;
    }

//    記事のアップロード処理
    public function save_article($input){
        list($photo_name_array,$lng,$lat) = [];
        $set_path = public_path('images/'.Auth::user()->id);
        if(!File::exists($set_path))
        {
            File::makeDirectory($set_path);
        }
        foreach ($input['photos'] as $photo_data ){
            $mime = $photo_data->getClientOriginalExtension();
            $location_info = $this->main_exif($photo_data);
            array_push($lat,$location_info['lat']);
            array_push($lng,$location_info['lng']);
            $name = md5(sha1(uniqid(mt_rand(0,100000), true))).'.'.$mime;
            //        todo aws S3にアップロードする
            $image = Image::make($photo_data->getRealPath())->resize(500,null, function ($constraint) {
                $constraint->aspectRatio();
            });

//            if($photo_data->move($set_path, $name)){
//                array_push($photo_name_array,$name);
//            }
            // exifの判定
//            exifの削除
        }
        Log::info($lat);
        $article = new Article();
            $article->title = $input['MainTitle'];
            $article->subtitle = $input['SubTitle'];
            $article->photos = implode('+',$photo_name_array);
            $article->main_photo = $photo_name_array[0];
            $article->budgets = $input['budgets'];
            $article->user_id = Auth::user()->id;
            $article->latitude = implode('*',$lat);
            $article->longitude = implode('*',$lng);
            $article->departure_at = $input['departure_at'];
            $article->days = $input['days'];
            $article->nights = $input['night'];
//            try {
            $article->save();
//            } catch (Exception $e) {
//                echo "保存に失敗しました";
//            }
//        編集用に渡す配列を整形し直す
//        $input['lat'] = $location_info['lat'];
//        $input['log'] = $location_info['long'];
        Log::debug($article);
        return $article;
    }

    private function main_exif($photo_data){
        if( IMAGETYPE_JPEG == exif_imagetype($photo_data)){
            $exif = exif_read_data( $photo_data );
            Log::debug($exif);
            // 緯度を60進数から10進数に変換する
            $location_info['lat'] = $this->get_10_from_60_exif( $exif['GPSLatitudeRef'] , $exif['GPSLatitude']);
            // 経度を60進数から10進数に変換する
            $location_info['lng'] = $this->get_10_from_60_exif( $exif['GPSLongitudeRef'] , $exif['GPSLongitude']);
            return $location_info;
        }else{

            return false;
        }
    }
    /********************************************************
    Exifデータの位置情報を60進数から10進数に変換する関数
    第1引数:進行方向(["GPSLatitudeRef"]、["GPSLongitudeRef"])
    第2引数:60進数の配列(["GPSLatitude"]、["GPSLongitude"])
    返り値:10進数に直したデータ
     ********************************************************/


    private function get_10_from_60_exif( $ref , $gps )
    {
        // 60進数から10進数に変換
        $data = $this->convert_float( $gps[0] ) + ( $this->convert_float($gps[1])/60 ) + ( $this->convert_float($gps[2])/3600 ) ;
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
