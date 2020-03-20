<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;
    protected $table = 'items';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];
}
