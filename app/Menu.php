<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table      = 'menu';
    protected $primaryKey = 'id_menu';

    public static function loadMenu()
    {
        $id_perfil    = session('id_perfil');
        $menus_padres = Menu::where('id_padre', null)
            ->orderBy('orden', 'asc')
            ->get();

        $menu = '<ul class="nav navbar-nav">';
        foreach ($menus_padres as $menu_padre) {

            //primero miramos si tiene permiso para ese menu padre
            $menu_perfil = MenuPerfil::where('id_perfil', $id_perfil)
                ->where('id_menu', $menu_padre->id_menu)
                ->where('estado', 1)
                ->first();
            if ($menu_perfil) {
                //primero miramos si tiene hijos el menu padre
                $menu_hijos = Menu::where('id_padre', $menu_padre->id_menu)
                    ->orderBy('orden', 'asc')
                    ->get();
                if (count($menu_hijos) > 0) {
                    $menu .= '<li class="menu-item-has-children dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-' . $menu_padre->icono . '"></i>' . $menu_padre->nombre . '</a>
                                <ul class="sub-menu children dropdown-menu">';
                    foreach ($menu_hijos as $menu_hijo) {
                        //ahora se pregunta si tiene menuperfil el hijo actual
                        $menu_perfil_hijo = MenuPerfil::where('id_perfil', $id_perfil)
                            ->where('id_menu', $menu_hijo->id_menu)
                            ->where('estado', 1)
                            ->first();
                        if ($menu_perfil_hijo) {
                            $menu .= '<li><i class="fa fa-' . $menu_hijo->icono . '"></i> <a href="' . config('global.url_base') . '/' . $menu_hijo->ruta . '">' . $menu_hijo->nombre . '</a></li>';
                        }

                    }
                    $menu .= '</ul>
                             </li>';
                } else {
                    //aca es porque no tiene hijos el menu padre
                    $menu .= '<li>
                                <a href="' . config('global.url_base') . '/' . $menu_padre->ruta . '"> <i class="menu-icon fa fa-' . $menu_padre->icono . '"></i>' . $menu_padre->nombre . '</a>
                              </li>';
                }
            }
        }
        $menu .= '</ul>';

        echo $menu;

    }
}
