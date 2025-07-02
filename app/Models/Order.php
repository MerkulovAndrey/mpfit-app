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

    // Информация о заказе
    public static function showFullOrderInfo($orderId)
    {
        $sql = <<<'EOT'
            SELECT o.id, o.status, o.created_at, o.client_name, o.client_comment
                ,JSON_ARRAYAGG(g.name) AS goods
                ,COALESCE(SUM(g.price), 0) AS full_price
            FROM orders o 
            LEFT JOIN lnk_orders_goods log2 ON log2.orders_id = o.id
            LEFT JOIN goods g ON g.id = log2.goods_id
            WHERE o.id = ?
            GROUP BY o.id, o.status, o.created_at, o.client_name, o.client_comment;
        EOT;
        
        $row = DB::selectOne($sql, [$orderId]);
        if (!isset($row->goods)) {
            $row->goods = array();
        } else {
            $row->goods = json_decode($row->goods);
        }
        return $row;
    }

    // Список всех заказов
    public static function showAll()
    {
        $sql = <<<'EOT'
            SELECT o.id, o.status, o.created_at, o.client_name, o.client_comment
                ,COALESCE(SUM(g.price), 0) AS full_price
            FROM orders o 
            LEFT JOIN lnk_orders_goods log2 ON log2.orders_id = o.id
            LEFT JOIN goods g ON g.id = log2.goods_id
            GROUP BY o.id, o.status, o.created_at, o.client_name, o.client_comment;
        EOT;
        
        return DB::select($sql);
    }
}
