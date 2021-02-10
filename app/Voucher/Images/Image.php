<?php


namespace App\Voucher\Images;


use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['imageable_id','imageable_type','url_img'];

    public $timestamps = false;

    public function imageable()
    {
        return $this->morphTo();
    }


}
