<?php

namespace App\Models;

use Error;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'status',
        'client_name',
        'client_comment'
    ];


    // Привязка товаров к заказу
    public function createOrderGoodsLink($goodsIdList)
    {
        if (count($goodsIdList) > 0) {
            foreach($goodsIdList as $id) {
                if (!DB::table('lnk_orders_goods')->insert([
                    'goods_id' => (int)$id,
                    'orders_id' => (int)$this->attributes['id']
                ])) {
                    throw new Exception("Ошибка привязки товара $id к заказу $this->id");
                }
            }
        } else {
            throw new Exception('Пустой список кодов товаров');
        }

    }
}
