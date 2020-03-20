<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'name_first',
        'name_last',
        'company',
        'email',
        'phone',
        'shipping_address',
        'note',
        'payment_method',
        'status',
        'grand_total',
        'note'
    ];

    public function Items() {
        return $this->hasMany('\App\Item');
    }
}
