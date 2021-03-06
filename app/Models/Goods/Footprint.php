<?php


namespace App\Models\Goods;


use App\Models\BaseModel;

class Footprint extends BaseModel
{
    protected $table = 'footprint';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'goods_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted' => 'boolean',
        'pic_list' => 'array'
    ];
}