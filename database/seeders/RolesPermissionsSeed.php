<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesPermissionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            "super-admin",
            "admin",
            "natural",
            "operario",
            "visitante",
        ];
        $permissions = [
            "*",
            "user-create",
            "user-update",
            "user-delete",
            "user-view",
            "person-create",
            "person-update",
            "person-delete",
            "person-view",
        ];

        $PeromissionInRoles = [
            [
                "role"=>"super-admin",
                "permissions"=>[
                    "*"
                ]
            ],
            [
                "role"=>"admin",
                "permissions"=>[
                   "user-create",
                   "user-update",
                   "user-delete",
                   "user-view",
                   "person-create",
                   "person-update",
                   "person-delete",
                   "person-view",

                ]
            ],
            [
                "role"=>"natural",
                "permissions"=>[
                   "user-view",
                   "person-view",

                ]

            ],
        ];

        foreach ($role as $rol)
        {

            DB::table('roles')->insert(['rol'=>$rol]);
        }
        foreach($permissions as  $permission)
        {
            DB::table('permissions')->insert(['permission'=>$permission]);
        }

        foreach( $PeromissionInRoles as $pandr)
        {
            // var_dump($pandr["role"]);
            $roleID = DB::table('roles')->where('rol', $pandr["role"])->value('id');
            // var_dump($roleID);
            foreach($pandr["permissions"] as $per)
            {
                $permissionID =DB::table('permissions')
                ->where('permission',$per)
                ->value('id');
                DB::table('roles_permissions')->insert([
                    "rol_id"=>$roleID,
                    "permission_id"=>$permissionID
                ]);
            }
        }
    }
}
