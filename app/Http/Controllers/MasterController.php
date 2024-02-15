<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SysMenu;
use Session;

class MasterController extends Controller
{
    public function index(){
        if ( Auth::check()) {
            // Role
            $jabatan = Auth::user()->role_id;
            $isi_roles = [];
            $query = DB::table('view_conf_role_menu')
            ->where('role_id', $jabatan)
            ->where('menu_aktif', '1')
            ->select('menu_kode')
            ->get();
            foreach($query as $values){
                $isi_roles[] = $values->menu_kode;
            }
            $roles = json_encode($isi_roles);
            // Header
            $header = '<ul class="kt-menu__nav ">';
            $query = SysMenu::where('menu_aktif', 1)->whereHas('roles', function ($query) use ($jabatan) {
                $query->where('role_id', $jabatan);
            })->orderBy('menu_order', 'asc')->get();
            foreach($query as $values){
                if($values['menu_parent'] == '#'){
                    $header .= '<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a onclick="loadSidebar(this)" data-id="' . $values['menu_id'] . '" data-page="' . $values['menu_kode'] . '" data-name="' . $values['menu_judul'] . '" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">' . $values['menu_judul'] . '</span><i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a></li>';
                }
            }
            $header .= '</ul>';
            // Sidebar
            $html = '<ul class="kt-menu__nav" style="padding-top: 0px;">';
            $start = SysMenu::where('menu_aktif', 1)->where('menu_id', 'A001')->where('menu_level', 1)->whereHas('roles', function ($query) use ($jabatan) {
                $query->where('role_id', $jabatan);
            })->orderBy('menu_order', 'asc')->first();
            $html .= '<li class="kt-menu__section "><h4 class="kt-menu__section-text">'. $start['menu_judul'] .'</h4><i class="kt-menu__section-icon flaticon-more-v2"></i></li>';
            $sidebar = SysMenu::where('menu_aktif', 1)->where('menu_level', 2)->where('menu_parent', $start['menu_id'])->whereHas('roles', function ($query) use ($jabatan) {
                $query->where('role_id', $jabatan);
            })->orderBy('menu_order', 'asc')->get();
            foreach($sidebar as $values){
                if($values['menu_sub'] == 1){
                    $extend = SysMenu::where('menu_aktif', 1)
                    ->where('menu_parent', $values['menu_id'])
                    ->where('menu_level', 3)
                    ->whereHas('roles', function ($query) use ($jabatan) {
                        $query->where('role_id', $jabatan);
                    })
                    ->orderBy('menu_order', 'asc')
                    ->get();
                    foreach($extend as $valext){
                        $html .= '<li class="kt-menu__item " aria-haspopup="true"><a id="new-page-button" data-page="' . $valext['menu_kode'] . '" data-name="' . $valext['menu_judul'] . '" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-icon ' . $valext['menu_icon'] . '"></i><span class="kt-menu__link-text">' . $valext['menu_judul'] . '</span></a></li>';
                    }
                }else{
                    if($values['menu_kode'] == 'dashboard'){
                        $html .= '<li class="kt-menu__item kt-menu__item--active" aria-haspopup="true"><a id="new-page-button" data-page="' . $values['menu_kode'] . '" data-name="' . $values['menu_judul'] . '" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">' . $values['menu_judul'] . '</span></a></li>';
                    }else{
                        $html .= '<li class="kt-menu__item " aria-haspopup="true"><a id="new-page-button" data-page="' . $values['menu_kode'] . '" data-name="' . $values['menu_judul'] . '" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">' . $values['menu_judul'] . '</span></a></li>';
                    }
                }
            }
            $html .= '</ul>';
            // Response
            return view('index', compact('html', 'header', 'roles'));
        } else {
            return view('login');
        }
    }

    public function sidebar_panel(Request $request){
        $var = $request->all();
        $startpage = $var['startpage'];
        $arr = array();
        $jabatan = Auth::user()->role;
        // $jabatan = 'RL001';
        // Sidebar
        $html = '<ul class="kt-menu__nav" style="padding-top: 0px;">';
        $start = SysMenu::where('menu_aktif', 1)->where('menu_id', $var['menu_id'])->where('menu_level', 1)->whereHas('roles', function ($query) use ($jabatan) {
            $query->where('role_id', $jabatan);
        })->orderBy('menu_order', 'asc')->first();
        $html .= '<li class="kt-menu__section "><h4 class="kt-menu__section-text">'. $start['menu_judul'] .'</h4><i class="kt-menu__section-icon flaticon-more-v2"></i></li>';
        $sidebar = SysMenu::where('menu_aktif', 1)->where('menu_level', 2)->where('menu_parent', $start['menu_id'])->whereHas('roles', function ($query) use ($jabatan) {
            $query->where('role_id', $jabatan);
        })->orderBy('menu_order', 'asc')->get();
        $menu_upper = '<div class="row">
								<div class="col-xl-12">
									<div class="kt-portlet">
										<div class="row row-no-padding">';
        $atas = "";
        foreach($sidebar as $values){
            if($values['menu_sub'] == 1){
                $html .= '
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">'.$values['menu_judul'].'</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">'.$values['menu_judul'].'</span></span></li>
                ';
                array_push($arr, (string)$values['menu_judul']);
                $extend = SysMenu::where('menu_aktif', 1)
                ->where('menu_parent', $values['menu_id'])
                ->where('menu_level', 3)
                ->whereHas('roles', function ($query) use ($jabatan) {
                    $query->where('role_id', $jabatan);
                })
                ->orderBy('menu_order', 'asc')
                ->get();
                foreach($extend as $valext){
                    $html .= '<li class="kt-menu__item " aria-haspopup="true"><a id="new-page-button" data-page="' . $valext['menu_kode'] . '" data-name="' . $valext['menu_judul'] . '" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">'.$valext['menu_judul'].'</span></a></li>';
                    array_push($arr, (string)$valext['menu_judul']);
                }
                $html .= '</ul>
                    </div>
                </li>';
            }else{
                if($values['menu_kode'] == 'dashboard'){
                    if($var['startpage'] == 'start'){
                        $html .= '<li class="kt-menu__item kt-menu__item--active" aria-haspopup="true"><a id="new-page-button" data-page="' . $values['menu_kode'] . '" data-name="' . $values['menu_judul'] . '" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">' . $values['menu_judul'] . '</span></a></li>';
                        array_push($arr, (string)$values['menu_judul']);
                    }else{
                        $html .= '<li class="kt-menu__item " aria-haspopup="true"><a id="new-page-button" data-page="' . $values['menu_kode'] . '" data-name="' . $values['menu_judul'] . '" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">' . $values['menu_judul'] . '</span></a></li>';
                        array_push($arr, (string)$values['menu_judul']);
                    }
                }else{
                    $html .= '<li class="kt-menu__item " aria-haspopup="true"><a id="new-page-button" data-page="' . $values['menu_kode'] . '" data-name="' . $values['menu_judul'] . '" onclick="loadPage(this, event)" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">' . $values['menu_judul'] . '</span></a></li>';
                    array_push($arr, (string)$values['menu_judul']);
                }
            }
            // Coba isian kotak
            if (sizeof($sidebar) <= 4) {
                $atas = "col-lg-6 col-xl-3";
            } else if (sizeof($sidebar) <= 10) {
                $atas = "col-lg-6 col-xl-2";
            }
            $menu_upper .= '
                <div class="' . $atas . '">
                    <div class="kt-pricing-v1 kt-pricing-v1--danger">
                        <div class="kt-pricing-v1__header">
                            <div class="kt-iconbox kt-iconbox--no-hover">
                                <div class="kt-iconbox__icon" style="color:#646c9a">
                                    <div class="kt-iconbox__icon-bg"></div>
                                    <i class="' . $values['menu_icon'] . '"></i>
                                </div>
                                <div class="kt-iconbox__title">
                                    ' . $values['menu_judul'] . '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        $html .= '</ul>';
        $menu_upper .= '</div></div></div></div>';
        $content = array(
            'html' => base64_encode($html),
            'list' => $arr,
            'misc' => base64_encode($menu_upper)
        );
        // Response
        return $content;
    }

    public function login(Request $request){
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = request()->except(['_token']);

        if(Auth::attempt($data)){
            return redirect('/');
        }else{
            Session::flash('error', 'Email/Password salah !');
            return redirect('/');
        }
    }

    public function logout(){
        Auth::logout(); 
        Session::flash('success', 'Berhasil logout !');
        return redirect('/');
    }
}
