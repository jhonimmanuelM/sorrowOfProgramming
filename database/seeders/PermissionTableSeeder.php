<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use DB;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'referral-list',
           'referral-create',
           'referral-edit',
           'referral-delete',
           'NHR-list',
           'NHR-create',
           'NHR-edit',
           'NHR-delete',
           'settings-list'
        ];
        $role = DB::table('roles')->insert(['name' => 'BBA','guard_name' => 'web']);
        $role = DB::table('roles')->first();
        foreach ($permissions as $permission) {
            $permission =  Permission::create(['name' => $permission]);
            DB::table('role_has_permissions')->insert(['permission_id' => $permission->id,'role_id' => $role->id]);
        }
        DB::table('model_has_roles')->insert(['role_id'=>$role->id,'model_type' => 'App\Models\User','model_id'=> 1]);

        $permissions = [
           'referral-list',
           'referral-create',
           'referral-edit',
           'referral-delete',
           'NHR-list',
           'NHR-create',
           'NHR-edit',
           'NHR-delete'
        ];
        $role = DB::table('roles')->insertGetId(['name' => 'Recruiter','guard_name' => 'web']);
        $role = DB::table('roles')->where('id',$role)->first();
        foreach ($permissions as $permission) {
          $permission =  Permission::where('name', $permission)->first();
            DB::table('role_has_permissions')->insert(['permission_id' => $permission->id,'role_id' => $role->id]);
        }
        DB::table('model_has_roles')->insert(['role_id'=>$role->id,'model_type' => 'App\Models\User','model_id'=> 2]);

        $permissions = [
           'referral-list',
           'referral-create',
           'referral-edit',
           'referral-delete',
           'NHR-list',
           'NHR-create',
           'NHR-edit',
           'NHR-delete'
        ];
        $role = DB::table('roles')->insertGetId(['name' => 'TL','guard_name' => 'web']);
        $role = DB::table('roles')->where('id',$role)->first();
        foreach ($permissions as $permission) {
          $permission =  Permission::where('name', $permission)->first();
            DB::table('role_has_permissions')->insert(['permission_id' => $permission->id,'role_id' => $role->id]);
        }
        DB::table('model_has_roles')->insert(['role_id'=>$role->id,'model_type' => 'App\Models\User','model_id'=> 3]);

        $permissions = [
           'referral-list',
           'referral-create',
           'referral-edit',
           'referral-delete',
           'NHR-list',
           'NHR-edit'
        ];
        $role = DB::table('roles')->insertGetId(['name' => 'Interviewer','guard_name' => 'web']);
        $role = DB::table('roles')->where('id',$role)->first();
        foreach ($permissions as $permission) {
            $permission =  Permission::where('name', $permission)->first();
            DB::table('role_has_permissions')->insert(['permission_id' => $permission->id,'role_id' => $role->id]);
        }
        DB::table('model_has_roles')->insert(['role_id'=>$role->id,'model_type' => 'App\Models\User','model_id'=> 4]);

        $permissions = [
           'referral-list',
           'referral-create',
           'referral-edit',
           'referral-delete'
        ];
        $role = DB::table('roles')->insertGetId(['name' => 'Employee','guard_name' => 'web']);
        $role = DB::table('roles')->where('id',$role)->first();
        foreach ($permissions as $permission) {
            $permission =  Permission::where('name', $permission)->first();
            DB::table('role_has_permissions')->insert(['permission_id' => $permission->id,'role_id' => $role->id]);
        }
        DB::table('model_has_roles')->insert(['role_id'=>$role->id,'model_type' => 'App\Models\User','model_id'=> 5]);
    }
}
