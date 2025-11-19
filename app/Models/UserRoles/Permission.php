<?php

namespace App\Models\UserRoles;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    protected $fillable = [
        'name', 'name_display', 'description'
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public static function isAllowed($roleId, $permName): bool
    {

        $allowed = false;

        $sql = <<<'EOT'
            SELECT uprl.permission_id
            FROM users_permissions_roles_link uprl
            JOIN users_permissions up ON up.id = uprl.permission_id
            WHERE uprl.role_id = 3 AND up.name = 'cats.update';
        EOT;
        $rows = DB::select($sql);

        if (count($rows) == 1) {
            $allowed = true;
        }

        return $allowed;
    }
}