<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\MenuAdmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenus;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class MenuAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        if(!\Auth::user()->can('edit_menu_admin'))
        {
            abort('403');
        }
        
        $role = Role::findOrFail($id);
        $menus = MenuAdmin::with('children')->where('parent_id',null)->where('role_id', $role->id)->orderBy('order')->get();
        // dd($menus);
        return view('admin::settings.menu_admin.index', compact('menus', 'role'));
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
        // dd($request->all());
        if(!\Auth::user()->can('create_menu_admin'))
        {
            abort('403');
        }
        $validated = \Validator::make($request->all() ,[
            'title' => ['required', 'max:255'],
            'url' => ['required', 'max:225']
        ],
        $messages = [
            'title.required' => 'Nama menu harus diisi',
            'url.required' => 'Route harus diisi',
        ]);

        if (! $validated->fails()) {
            MenuAdmin::create([
                'title' => $request->title,
                'url' => $request->url,
                'parent_id' => $request->parent_id ?? null,
                'role_id' => $request->role_id,
                'icon_class' => $request->icon_class,
                'order' => empty($request->parent_id) ? MenuAdmin::where('parent_id', null)->latest('order')->first()['order']+1 : ((MenuAdmin::where('parent_id', $request->parent_id)->latest('order')->first()['order'] != null) ? MenuAdmin::where('parent_id', $request->parent_id)->latest('order')->first()['order']+1 : 1) ,
            ]);

            return redirect()->back()->with(['success' => 'Berhasil tambah menu']);
        }

        $validated->errors()->add('form_active', 'store');
        return redirect()->back()->withErrors($validated);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuAdmin  $menuAdmin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(!\Auth::user()->can('edit_menu_admin'))
        {
            abort('403');
        }
        
        $role = Role::findOrFail($id);
        $menus = MenuAdmin::with('children')->where('parent_id',null)->where('role_id', $role->id)->orderBy('order')->get();
        // dd($menus);
        return view('admin::settings.menu_admin.index', compact('menus', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuAdmin  $menuAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuAdmin $menuAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuAdmin  $menuAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMenus $request, MenuAdmin $menuadmin)
    {
        //
        if(!\Auth::user()->can('edit_menu_admin'))
        {
            abort('403');
        }

        $menuadmin->title = $request->menu_label;
        $menuadmin->url = $request->menu_route_index;
        $menuadmin->icon_class = $request->menu_icon;

        $menuadmin->update();
        return redirect()->back()->with('success', "berhasil update data");
    }

    public function orderupdate(Request $request) {
        $type = array_keys($request->user_menu_orderby);
        if ($type[0] == 'down') {
            $idmenu = $request->user_menu_orderby['down'];
            $order = MenuAdmin::where('id', $idmenu)->first('order')->toArray();
            $orderplus = $order['order']+1;
            // dd($orderplus);
            if ($request->parent_id != null) {
                MenuAdmin::where('order', $orderplus)->where('parent_id', $request->parent_id)->update([
                    'order' => $order['order']
                ]);
            } else {
                MenuAdmin::where('order', $orderplus)->where('parent_id', null)->update([
                    'order' => $order['order']
                ]);
            }

            MenuAdmin::where('id', $idmenu)->update([
                'order' => $orderplus
            ]);

            return redirect()->back()->with('success', "berhasil sorting data");
           
           
        } else {
            $idmenu = $request->user_menu_orderby['up'];
            $order = MenuAdmin::where('id', $idmenu)->first('order')->toArray();
            // var_dump($order['orderby']);
            // die();

            $ordermin = $order['order']-1;
            // dd($orderplus);
            if ($request->parent_id != null) {
                MenuAdmin::where('order', $ordermin)->where('parent_id', $request->parent_id)->update([
                    'order' => $order['order']
                ]);
            }else{
                MenuAdmin::where('order', $ordermin)->where('parent_id', null)->update([
                    'order' => $order['order']
                ]);
            }

            // berdasarkan id menu
            MenuAdmin::where('id', $idmenu)->update([
                'order' => $ordermin
            ]);

            // berdasarkan id menu
            return redirect()->back()->with('success', "berhasil sorting data");
      
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuAdmin  $menuAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!\Auth::user()->can('delete_menu_admin'))
        {
            abort('403');
        }
        MenuAdmin::findOrFail($id)->delete();
        // $apasih->de­lete();
        if(MenuAdmin::where('parent_id', $id) != null) {
            MenuAdmin::where('parent_id', $id)->delete();
            // $hapus->delete();
        }

        return redirect()->back()->with(['success' => 'Berhasil hapus data']);
    }
}
