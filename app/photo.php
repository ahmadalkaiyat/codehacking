<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class photo extends Model
{
    //

    protected  $uploads = "/images/";  // where we upload the images so we are not hardcoded

    protected $fillable=['file'];

public function getFileAttribute($photo){

    return $this->uploads.$photo;
}

}
