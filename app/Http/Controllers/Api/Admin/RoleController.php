<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use DB;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        try{
            $roles = Role::all();
            return responseJson(1, 'Success', $roles);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    }

    public function create(){
        try{
            $permissions = Permission::all();
            return responseJson(1, 'Success', $permissions);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    }
    
    public function store(Request $request)
    {
        try{
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:roles,name',
                'permission_id' => 'required',
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // satrt create
            DB::beginTransaction();
            // dd($request->permission_id);
            $role = Role::create(['name' => $request->input('name')]);
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return $ex;
            return responseJson(0, 'There Is Something Wrong');
        }

    }
    
    public function edit($id)
    {
        try{
            $role = Role::findOrFail($id);
            return responseJson(1, 'Success', $role);
        }catch(\Exception $ex){
            return responseJson(1, 'There Is Something Wrong');
        }
    }
    
    public function update(Request $request, $id)
    {
        try{
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:roles,name,'. $id,
                'permission_id' => 'required',
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // satrt update
            DB::beginTransaction();
            $role = Role::findOrFail($id);
            $role->update([
                'name' => $request->input('name')
            ]);
            $role->permissions()->sync($request->permission_id);
            $role->save();
            DB::commit();
            return responseJson(1, 'Updated Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return $ex;
            return responseJson(0, 'There Is Something Wrong');
        }
    }
    
    public function delete($id)
    {
        try{
            $role = Role::findOrFail($id);
            $role->delete();
            return responseJson(1, 'Deleted Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }
    }
}