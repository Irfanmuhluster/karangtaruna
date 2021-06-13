<?php

namespace App\View\Components\Admin\Layouts;

use App\Models\MenuAdmin;
use Illuminate\View\Component;
use Spatie\Permission\Models\Role;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $role = \Auth::user()->roles->first();
        // dd($role);
        $menus = MenuAdmin::with('children')->where('parent_id',null)->where('role_id', $role->id)->orderBy('order')->get();
        

        return view('components.admin.layouts.sidebar', compact('menus'));
    }
}
