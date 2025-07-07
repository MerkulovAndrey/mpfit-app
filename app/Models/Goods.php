<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Goods extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'category_id',
        'description',
        'price',
        'deleted'
    ];

    /**
     * Список товаров в категориях
     *
     * @return array $res
     */
    public static function getCatalog(): array
    {
        $sql = <<<'EOT'
            SELECT c.name AS category, JSON_ARRAYAGG(JSON_OBJECT('id', g.id, 'name', g.name)) AS goods
            FROM goods g 
            JOIN categories c ON c.id = g.category_id
            WHERE g.deleted = 0
            GROUP BY c.name
        EOT;
        $rows = DB::select($sql);
        $res = array();

        foreach($rows as $item) {

            $goods = json_decode($item->goods, true);

            array_push($res, [
                'category' => $item->category,
                'goods' => $goods
            ]);
        }

        return $res;
    }

}