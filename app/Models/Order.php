<?php

namespace App\Models;

use Exception;
use Illuminate\Http\Request;
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

    // Создание заказа
    /**
     * Создание заказа
     *
     * @param  \Illuminate\Http\Request  $request
     * @throws \Exception
     */
    public static function createOrder(Request $request)
    {
        $goodsIdList = $request->input()['goods'];
        if (count($goodsIdList) > 0) {

            $params = [
                'request' => $request,
                'idList' => $goodsIdList
            ];

            DB::transaction(function() use ($request, $goodsIdList) {
                // создание заказа
                $order = SELF::create($request->post());

                // Привязка товаров к заказу
                foreach($goodsIdList as $id) {
                    DB::table('lnk_orders_goods')->insert([
                        'goods_id' => (int)$id,
                        'orders_id' => (int)$order->attributes['id']
                    ]); 
                }
            });
        } else {
            throw new Exception('Пустой список кодов товаров');
        }
    }

    /**
     * Информация о заказе
     *
     * @param  int  $orderId
     * @return mixed $row
     */
    public static function showFullOrderInfo($orderId)
    {
        $sql = <<<'EOT'
            SELECT o.id, o.status, o.created_at, o.client_name, o.client_comment
                ,JSON_ARRAYAGG(g.name) AS goods
                ,JSON_ARRAYAGG(CAST(g.price AS CHAR)) AS prices
                ,COALESCE(SUM(g.price), 0) AS full_price
            FROM orders o 
            LEFT JOIN lnk_orders_goods log2 ON log2.orders_id = o.id
            LEFT JOIN goods g ON g.id = log2.goods_id
            WHERE o.id = ?
            GROUP BY o.id, o.status, o.created_at, o.client_name, o.client_comment;
        EOT;
        
        $row = DB::selectOne($sql, [$orderId]);
        if (!isset($row->goods)) {
            $row->goods = [];
            $row->prices = [];
        } else {
            $row->goods = json_decode($row->goods);
            $row->prices = json_decode($row->prices);
        }
        return $row;
    }

    /**
     * Список всех заказов
     *
     * @return array
     */
    public static function showAll(): array
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
