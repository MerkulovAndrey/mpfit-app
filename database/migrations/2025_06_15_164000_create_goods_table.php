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
        $sql = <<<'EOT'
            CREATE TABLE IF NOT EXISTS categories (
                id INT UNSIGNED NOT NULL COMMENT 'Код категории товара',
                name varchar(100) NOT NULL COMMENT 'Название категории',
                CONSTRAINT categories_pk PRIMARY KEY (id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci
            COMMENT='Категории товаров';
        EOT;
        DB::statement($sql, []);

        $sql = <<<'EOT'
            CREATE TABLE IF NOT EXISTS goods (
                id INT UNSIGNED auto_increment NOT NULL COMMENT 'код товара',
                name varchar(255) NOT NULL COMMENT 'название товара',
                category_id INT UNSIGNED NOT NULL COMMENT 'код категории товара',
                description varchar(2048) NULL COMMENT 'описание товара',
                price DECIMAL(12,2) DEFAULT 0 NOT NULL COMMENT 'Цена товара',
                CONSTRAINT goods_pk PRIMARY KEY (id),
                CONSTRAINT goods_categories_FK FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT ON UPDATE CASCADE
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci
            COMMENT='Товары';
        EOT;
        DB::statement($sql, []);
                
        $sql = <<<'EOT'
            CREATE TABLE IF NOT EXISTS orders (
                id INT UNSIGNED NOT NULL COMMENT 'Код заказа',
                status ENUM('новый','выполнен') DEFAULT 'новый' NOT NULL COMMENT 'Статус заказа',
                created_at DATETIME DEFAULT now() NOT NULL COMMENT 'Время создания заказа',
                client_name varchar(100) NOT NULL COMMENT 'ФИО покупателя',
                client_comment varchar(2048) NULL COMMENT 'Комментарий покупателя',
                CONSTRAINT orders_pk PRIMARY KEY (id)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci
            COMMENT='Заказы';
        EOT;
        DB::statement($sql, []);

        $sql = <<<'EOT'
            CREATE TABLE IF NOT EXISTS lnk_orders_goods (
                goods_id INT UNSIGNED NOT NULL COMMENT 'Код товара',
                orders_id INT UNSIGNED NOT NULL COMMENT 'Код заказа',
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lnk_orders_goods');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('goods');
        Schema::dropIfExists('categories');
    }
};
