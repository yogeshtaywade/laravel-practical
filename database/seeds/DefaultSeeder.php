<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::firstOrNew(['email'=>'superadmin@gmail.com']);
        $superAdmin->first_name="Super";
        $superAdmin->last_name="Admin";
        $superAdmin->phone="";
        $superAdmin->image="";
        $superAdmin->password = bcrypt('admin@111');
    	$superAdmin->save();

        $fixed_roles = config()->get('settings.fixed_roles');
        $permissions = config()->get('permissions.permissions');

        foreach ($fixed_roles as $key=>$role){
            $newRole=Role::firstOrNew(['name'=>$key]);
            $newRole->label=$role['label'];
            $newRole->save();
        }

        $super_admin_role= Role::where('name','super_admin')->first();

        if($super_admin_role && count($super_admin_role)>0){
            $super_admin_role->permissions()->detach();
            foreach($permissions as $type => $permission){
                foreach ($permission as $key => $value){
                    $newPermission= Permission::firstOrNew(['name'=>$key]);
                    $newPermission->label = $value;
                    $newPermission->group = $type;
                    if($newPermission->save()){
                        $super_admin_role->givePermissionTo($newPermission);
                    }
                }
            }
            $superAdmin->assignRole($super_admin_role);
        }

    }
}
