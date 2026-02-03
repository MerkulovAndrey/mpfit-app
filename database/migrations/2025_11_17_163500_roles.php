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
            CREATE TABLE laravel.users_roles (
                id INT UNSIGNED auto_increment NOT NULL COMMENT 'Код роли',
                name varchar(64) NOT NULL COMMENT 'Cистемное имя роли',
                name_display varchar(255) NOT NULL COMMENT 'Имя роли для отображения в UI',
                description varchar(1024) NULL COMMENT 'Описание роли',
                CONSTRAINT users_roles_pk PRIMARY KEY (id),
                CONSTRAINT users_roles_unique UNIQUE KEY (name)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci
            COMMENT='Роли пользователей';
        EOT;
        DB::statement($sql, []);

        $sql = <<<'EOT'
            CREATE TABLE laravel.users_permissions (
                id INT UNSIGNED auto_increment NOT NULL COMMENT 'Код права',
                name varchar(64) NOT NULL COMMENT 'Cистемное имя права',
                name_display varchar(255) NOT NULL COMMENT 'Имя права для отображения в UI',
                description varchar(1024) NULL COMMENT 'Описание права',
                CONSTRAINT users_permissions_pk PRIMARY KEY (id),
                CONSTRAINT users_permissions_unique UNIQUE KEY (name)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci
            COMMENT='Права пользователей';
        EOT;
        DB::statement($sql, []);

        $sql = <<<'EOT'
            CREATE TABLE laravel.users_permissions_roles_link (
                role_id INT UNSIGNED NOT NULL,
                permission_id INT UNSIGNED NOT NULL,
                CONSTRAINT users_permissions_roles_link_users_roles_FK FOREIGN KEY (role_id) REFERENCES laravel.users_roles(id) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT users_permissions_roles_link_users_permissions_FK FOREIGN KEY (permission_id) REFERENCES laravel.users_permissions(id) ON DELETE CASCADE ON UPDATE CASCADE
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci
            COMMENT='Связь прав и ролей';
        EOT;
        DB::statement($sql, []);

        $sql = <<<'EOT'
            INSERT INTO laravel.users_roles (name, name_display, description)
            VALUES
                ('norole', 'Нет роли', 'Роль без прав (по умолчанию)'),
                ('admin', 'Администратор', 'Все права'),
                ('manager', 'Менеджер', 'Создание, обновление, удаление с ограничениями'),
                ('user', 'Обычный пользователь', 'Только просмотр')
        EOT;
        DB::statement($sql, []);

        DB::statement("ALTER TABLE laravel.users ADD role_id INT UNSIGNED DEFAULT 1 NOT NULL COMMENT 'Код роли'", []);
        DB::statement("ALTER TABLE laravel.users ADD CONSTRAINT users_users_roles_FK FOREIGN KEY (role_id) REFERENCES laravel.users_roles(id) ON DELETE RESTRICT ON UPDATE CASCADE;", []);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE laravel.users DROP COLUMN role_id", []);
        Schema::dropIfExists('users_permissions_roles_link');
        Schema::dropIfExists('users_roles');
        Schema::dropIfExists('users_permissions');

    }
};
