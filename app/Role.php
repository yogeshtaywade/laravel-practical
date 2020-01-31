<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name','label'
    ];
    
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function setNameAttribute($value) {
        $this->attributes['name'] = strtolower($value);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    /*
     * Give permission to role
     *
     * @return collections
     */

    public function givePermissionTo(Permission $permission) {
        return $this->permissions()->save($permission);
    }
   
}
