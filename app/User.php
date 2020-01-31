<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','image','phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    public function assignRole(Role $role)
    {
        return $this->roles()->sync($role);
    }
    
    public function hasRole($role)
    {
        if(is_string($role)){
            return $this->roles->contains('name',$role);
        }

        foreach ($role as $r) {
            if($this->hasRole($r->name)){
                return true;
            }
        }

        return false;
    }
    
    public function hasPermission($permission)
    {
        if(is_string($permission)){
            return $this->roles[0]->permissions->contains('name',$permission);
        }
    }
}
