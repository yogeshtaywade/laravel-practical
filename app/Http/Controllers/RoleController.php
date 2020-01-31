<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Permission;
use Illuminate\Support\Facades\Auth;
use App\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->get();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $permission_ids = Auth::user()->roles[0]->permissions->pluck('id');
         $permissions = Permission::whereIn('id', $permission_ids)->get()->groupBy('group');
         return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name|alpha_dash|min:3|max:190',
            'label' => 'required|min:3|max:190',
            'permission' => 'required',
         ]);

        $role = new Role;
        $role->name = $request->get('name');
        $role->user_id = Auth::user()->id;
        $role->label = $request->get('label');
        if ($role->save()) {
            $role->permissions()->sync($request->get('permission'));
            return redirect(route('role.index'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permission_ids = Auth::user()->roles[0]->permissions->pluck('id');
        $permissions = Permission::whereIn('id', $permission_ids)->get()->groupBy('group');
        return view('role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'label' => 'required|min:3|max:190',
            'permission' => 'required',
         ]);
//        $this->validate($request,$rules);
        $role = Role::findOrFail($id);
        $role->label = $request->get('label');
        $role->user_id = Auth::user()->id;
        if ($role->save()) {
            $role->permissions()->sync($request->get('permission'));
            return redirect(route('role.index'));
        } else {
            return redirect()->back();
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $role = Role::findOrFail($id);
            if ($role->delete()) {
                return response()->json(['success' => 'Successfully Role Deleted.']);
            }else{
                return response()->json(['errors' => 'Error in deleting role!']);
            }
        }
    }
}
