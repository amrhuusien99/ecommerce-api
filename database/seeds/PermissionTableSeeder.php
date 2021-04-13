<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

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

            // routes admin 
            $Permission = ['name' => 'Admins Show', 'route_name' => 'admin/index'],
            $Permission = ['name' => 'Admin create', 'route_name' => 'admin/create'],
            $Permission = ['name' => 'Admin Add', 'route_name' => 'admin/store'],
            $Permission = ['name' => 'Admin Delete', 'route_name' => 'admin/delete'],
            $Permission = ['name' => 'Admin Activate', 'route_name' => 'admin/activate'],
            $Permission = ['name' => 'Admin UnActivate', 'route_name' => 'admin/deactivate'],
            $Permission = ['name' => 'Admin role', 'route_name' => 'admin/role'],

            // routes role 
            $Permission = ['name' => 'Roles Show', 'route_name' => 'admin/roles/index'],
            $Permission = ['name' => 'Role Add', 'route_name' => 'admin/roles/store'],
            $Permission = ['name' => 'Role Delete', 'route_name' => 'admin/roles/delete'],
            $Permission = ['name' => 'Role Information', 'route_name' => 'admin/roles/show'],
            $Permission = ['name' => 'Role Edit', 'route_name' => 'admin/roles/edit'],
            $Permission = ['name' => 'Role Update', 'route_name' => 'admin/roles/update'],

            // routes vendor 
            $Permission = ['name' => 'Vendors Show', 'route_name' => 'admin/vendors'],
            $Permission = ['name' => 'Vendor Add', 'route_name' => 'admin/vendors/store'],
            $Permission = ['name' => 'Vendor Delete', 'route_name' => 'admin/vendors/delete'],
            $Permission = ['name' => 'Vendor Activate', 'route_name' => 'admin/vendors/activate'],
            $Permission = ['name' => 'Vendor UnActivate', 'route_name' => 'admin/vendors/deactivate'],
            $Permission = ['name' => 'Vendor Special', 'route_name' => 'admin/vendors/special'],
            $Permission = ['name' => 'Vendor UnSpecial', 'route_name' => 'admin/vendors/unspecial'],

            // routes user 
            $Permission = ['name' => 'Users Show', 'route_name' => 'admin/users'],
            $Permission = ['name' => 'User Add', 'route_name' => 'admin/users/store'],
            $Permission = ['name' => 'User Delete', 'route_name' => 'admin/users/delete'],
            $Permission = ['name' => 'User Activate', 'route_name' => 'admin/users/activate'],
            $Permission = ['name' => 'User UnActivate', 'route_name' => 'admin/users/deactivate'],

            // routes main categroy 
            $Permission = ['name' => 'Main Categories Show', 'route_name' => 'admin/main-category'],
            $Permission = ['name' => 'Main Category Add', 'route_name' => 'admin/main-category/store'],
            $Permission = ['name' => 'Main Category Edit', 'route_name' => 'admin/main-category/edit'],
            $Permission = ['name' => 'Main Category Update', 'route_name' => 'admin/main-category/update'],
            $Permission = ['name' => 'Main Category Delete', 'route_name' => 'admin/main-category/delete'],
            $Permission = ['name' => 'Main Category Activate', 'route_name' => 'admin/main-category/activate'],
            $Permission = ['name' => 'Main Category UnActivate', 'route_name' => 'admin/main-category/deactivate'],
            $Permission = ['name' => 'Main Category Lang AR', 'route_name' => 'admin/main-category/lang-ar'],
            $Permission = ['name' => 'Main Category Lang ES', 'route_name' => 'admin/main-category/lang_es'],

            // routes main categroy 
            $Permission = ['name' => 'Sub Categories Show', 'route_name' => 'admin/sub-category'],
            $Permission = ['name' => 'Sub Category Create', 'route_name' => 'admin/sub-category/create'],
            $Permission = ['name' => 'Sub Category Add', 'route_name' => 'admin/sub-category/store'],
            $Permission = ['name' => 'Sub Category Edit', 'route_name' => 'admin/sub-category/edit'],
            $Permission = ['name' => 'Sub Category Update', 'route_name' => 'admin/sub-category/update'],
            $Permission = ['name' => 'Sub Category Delete', 'route_name' => 'admin/sub-category/delete'],
            $Permission = ['name' => 'Sub Category Activate', 'route_name' => 'admin/sub-category/activate'],
            $Permission = ['name' => 'Sub Category UnActivate', 'route_name' => 'admin/sub-category/deactivate'],
            $Permission = ['name' => 'Sub Category Lang AR', 'route_name' => 'admin/sub-category/lang-ar'],
            $Permission = ['name' => 'Sub Category Lang ES', 'route_name' => 'admin/sub-category/lang-es'],
            
        ];
        foreach ($permissions as $row) {
            Permission::create($row);
        }
    }
}
