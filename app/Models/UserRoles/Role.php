<?php

namespace App\Models\UserRoles;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $fillable = [
        'name', 'name_display', 'description'
    ];

    public function permission() {
        return $this->belongsToMany(Permission::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

}