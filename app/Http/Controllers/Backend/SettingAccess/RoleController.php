<?php

namespace App\Http\Controllers\Backend\SettingAccess;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!\Auth::user()->can('read_role'))
        {
            abort('403');
        }
        $role = new Roles();
        $roles =  $role->search()
            ->orderBy('created_at', 'DESC')
            ->paginate(config('app.setting.backend.no_of_records'));
        // dd($role->all());
        $rank = $roles->firstItem();
        return view('admin::settingsaccess.roles.index', compact('roles', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(!\Auth::user()->can('create_role'))
        {
            abort('403');
        }
        $validated = \Validator::make($request->all() ,[
            'role_name' => ['required', 'max:255', 'unique:posts'],
        ],
        $messages = [
            'required' => 'Peran harus diisi',
        ]);

        if (! $validated->fails()) {
            Role::firstOrCreate(['name' => $request->role_name]);

            session()->flash('success', __('Role: <strong>' .  $request->role_name . '</strong> Ditambahkan'));
            return redirect()->route('admin.settingaccess.role.index');
        }

        $validated->errors()->add('form_active', 'store');
        return redirect()->route('admin.settingaccess.role.index')->withErrors($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        if(!\Auth::user()->can('edit_role'))
        {
            abort('403');
        }
        return view('admin::settingsaccess.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, 
            [
                'name' => 'required|min:5',
            ],
            [
                'name.required' => 'Nama peran harus diisi',
            ]
        );
        $update = Role::findOrFail($id);
        $update->name = $request->name;

        $update->update();
        
        session()->flash('success', 'Berhasil update');
        return redirect()->route('admin.settingaccess.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!\Auth::user()->can('delete_role'))
        {
            abort('403');
        }
        Role::findOrFail($id)->delete();
        // $apasih->de­lete();

        return redirect()->back()->with(['success' => 'Berhasil hapus pengguna']);
    }
}
