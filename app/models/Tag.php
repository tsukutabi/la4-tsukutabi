<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeles;

class Tag extends Model{

    protected $guarded = ['id'];
    protected $hidden = ['id','created_at','updated_at','modified_at','deleted_at'];
    protected $fillable = ['name'];
    public $timestamps = true;

    public function articles(){
        return $this->belongsToMany(Article::class);
    }



}