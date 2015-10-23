<?php

class Confirm extends Eloquent
{
    protected $fillable = [ 'key' ];

    public function user() {
        return $this->belongsTo('User');
    }

}