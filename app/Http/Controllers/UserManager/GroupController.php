<?php

namespace App\Http\Controllers\UserManager;

use App\GroupHasPermission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Junges\ACL\Http\Models\Group;
use Junges\ACL\Http\Models\Permission;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //list of groups with  permissions
    public function index()
    {
        $groups = Group::with('permissions')->get();
        return view('userManager.group.index')->with('groups', $groups);
    }

    //create page
    public function create()
    {
        $permissions = Permission::all();
        return view('userManager.group.create')->with('permissions', $permissions);
    }

    //store the groups
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:groups', 'max:255'],
        ]);

        $group = new Group();
        $group->name = $request->name;
        $group->slug = Str::slug($request->name, '-');
        $group->description = $request->description ?? null;

        if ($group->save()) {
            //add permission
            if ($request->permission_id != null) {
                $group->assignPermissions($request->permission_id);
                return redirect()->back()->with('success', translate('Group Create With Permission Successfully'));
            }
            return redirect()->back()->with('success', translate('Group Create Successfully'));
        } else {
            return redirect()->back()->with('failed', translate('There are Some Problem Try again '));
        }

    }

    //show group with permissions
    public function show($id)
    {
        try {
            $group = Group::where('id', $id)->with('permissions')->first();
            return view('userManager.group.show')->with('group', $group);
        } catch (Exception $e) {
            return redirect()->back()->with('failed', translate('There are Some Problem Try again '));
        }
    }

    //edit permissions
    public function edit($id)
    {

        try {
            $permissions = Permission::all();
            $group = Group::where('id', $id)->with('permissions')->first();
            return view('userManager.group.edit')
                ->with('group', $group)->with('permissions', $permissions);
        } catch (Exception $e) {
            return redirect()->back()->with('failed', translate('There are Some Problem Try again '));
        }
    }

    //update the group with permissions
    public function update(Request $request)
    {
        try {
            $group = Group::where('id', $request->id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'description' => $request->description,
            ]);
            //delete old data form group_has_permission table
            GroupHasPermission::where('group_id', $request->id)->delete();
            //after delete add new data in group_has_permission table
            if ($request->permission_id != null) {
                foreach ($request->permission_id as $id) {
                    $gpc = new GroupHasPermission();
                    $gpc->group_id = $request->id;
                    $gpc->permission_id = $id;
                    $gpc->save();
                }
            }
            if ($group) {
                return redirect()->back()->with('success', translate('Group Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again '));
            }
        } catch (Exception $e) {
            return redirect()->back()->with('failed', translate('There are Some Problem Try again '));
        }
    }

    //soft delete group
    public function destroy($id)
    {
        try {

            if (Group::where('id', $id)->forceDelete() || GroupHasPermission::where('group_id', $id)->forceDelete()) {
                return redirect()->back()->with('success', 'Group Delete Successfully');
            } else {
                return redirect()->back()->with('failed', 'There are Some Problem Try again ');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('failed', 'There are Some Problem Try again ' . $e);
        }
    }
}
