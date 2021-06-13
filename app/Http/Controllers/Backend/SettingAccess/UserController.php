<?php

namespace App\Http\Controllers\Backend\SettingAccess;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!\Auth::user()->can('read_user'))
        {
            abort('403');
        }
        $user = new User();

    	$datauser = $user->search()
            ->paginate(config('app.setting.backend.no_of_records'));

        $rank = $datauser->firstItem();
        return view('admin::settingsaccess.user.index', compact('datauser', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!\Auth::user()->can('create_user'))
        {
            abort('403');
        }
        $roles = Role::all()->pluck('name');
        return view('admin::settingsaccess.user.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        //
        if(!\Auth::user()->can('create_user'))
        {
            abort('403');
        }
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
        // dd($user);

        $user->assignRole($validated['role']);
        session()->flash('success', 'Berhasil tambah pengguna');
        return redirect()->route('admin.settingaccess.user.index');
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
    public function edit(User $user)
    {
        //
        if(!\Auth::user()->can('edit_user'))
        {
            abort('403');
        }
        $roles = Role::all()->pluck('name');
        return view('admin::settingsaccess.user.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        //
        if(!\Auth::user()->can('edit_user'))
        {
            abort('403');
        }
        $update = User::findOrFail($id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->assignRole($request->role);
        $update->update();
        session()->flash('success', 'Berhasil ubah pengguna');
        return redirect()->route('admin.settingaccess.user.index');
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
        if(!\Auth::user()->can('delete_user'))
        {
            abort('403');
        }
        User::findOrFail($id)->delete();
        // $apasih->de­lete();

        return redirect()->back()->with(['success' => 'Berhasil hapus pengguna']);
    }
}
