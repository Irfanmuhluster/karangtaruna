<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use Harimayco\Menu\Models\Menus;
use Illuminate\Http\Request;

class MenuPublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!\Auth::user()->can('kelola_menu'))
        {
            abort('403');
        }
        $menus = Menus::select(['id', 'name'])->orderBy('id')->get();

        return view('admin::settings.menu_public.index', compact('menus'));
    }

    //

    public function show($id)
    {
        if(!\Auth::user()->can('kelola_menu'))
        {
            abort('403');
        }
        $menu = Menus::where('id', 1)->with('items')->first();

        //you can access by model result
        $public_menu = $menu->items;

        return view('admin::settings.menu_public.index', compact('public_menu'));
    }
}
