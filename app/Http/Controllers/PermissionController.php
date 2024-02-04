<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StorePermissionsRequest;
use App\Http\Requests\UpdatePermissionsRequest;
use Illuminate\Support\Facades\Validator;
class PermissionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionsRequest $request)
    {
        $validator=Validator::make(
            $request->all(),
            $request->rules(),
        );
        if (!$validator->fails()) {
            Permission::create(['name' => $request->input('name')]);
            return redirect()->route('permissions.index');
        }else{
            //return response()->json(['error'=>$validator->errors()->all()]);
            //return response()->json($validator->errors()->all());
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionsRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {

        $permission->delete();

        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission)
    {


        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
