<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DROP TABLE IF EXISTS lnk_orders_goods", []);

        $sql = <<<'EOT'
            CREATE TABLE IF NOT EXISTS lnk_orders_goods (
                orders_id INT UNSIGNED NOT NULL COMMENT 'Код заказа',
                goods_id INT UNSIGNED NOT NULL COMMENT 'Код товара',
                CONSTRAINT lnk_orders_goods_goods_FK FOREIGN KEY (goods_id) REFERENCES goods(id) ON DELETE RESTRICT ON UPDATE CASCADE,
                CONSTRAINT lnk_orders_goods_orders_FK FOREIGN KEY (orders_id) REFERENCES orders(id) ON DELETE RESTRICT ON UPDATE CASCADE
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci
            COMMENT='Привязка товара к заказу. В заказе допускается только одно наименование товара';
        EOT;
        DB::statement($sql, []);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS lnk_orders_goods", []);

        $sql = <<<'EOT'
            CREATE TABLE IF NOT EXISTS lnk_orders_goods (
                orders_id INT UNSIGNED NOT NULL COMMENT 'Код заказа',
                goods_id INT UNSIGNED NOT NULL COMMENT 'Код товара',
                CONSTRAINT lnk_orders_goods_unique UNIQUE KEY (orders_id),
                CONSTRAINT lnk_orders_goods_categories_FK FOREIGN KEY (orders_id) REFERENCES categories(id) ON DELETE RESTRICT ON UPDATE CASCADE,
                CONSTRAINT lnk_orders_goods_orders_FK FOREIGN KEY (orders_id) REFERENCES orders(id) ON DELETE RESTRICT ON UPDATE CASCADE
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci
            COMMENT='Привязка товара к заказу. В заказе допускается только одно наименование товара';
        EOT;
        DB::statement($sql, []);
    }
};
