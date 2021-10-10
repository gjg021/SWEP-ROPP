<?php

namespace App\Http\Controllers;


use App\Models\User\PreRegistrationModel;
use Carbon\Carbon;
use Hash;
use App\Core\Interfaces\UserInterface;
use App\Core\Interfaces\UserMenuInterface;
use App\Core\Interfaces\UserSubmenuInterface;
use App\Core\Interfaces\MenuInterface;
use App\Core\Interfaces\SubmenuInterface;
use App\Http\Requests\User\UserFormRequest;
use App\Http\Requests\User\UserFilterRequest;
use App\Http\Requests\User\UserResetPasswordRequest;
use Illuminate\Http\Request;


class UserController extends Controller
{

    protected $user_repo;
    protected $user_menu_repo;
    protected $user_submenu_repo;
    protected $menu_repo;
    protected $submenu_repo;

    public function __construct()
    {

    }

    public function index(UserFilterRequest $request)
    {
        $users = $this->user_repo->fetch($request);
        $request->flash();
        return view('dashboard.user.index')->with('users', $users);
    }

    public function create()
    {
        return view('dashboard.user.create');
    }

    public function store(UserFormRequest $request)
    {
        $user = $this->user_repo->store($request);
        if (!empty($request->menu)) {
            foreach ($request->menu as $data_menu) {
                $menu = $this->menu_repo->findByMenuId($data_menu);
                $user_menu = $this->user_menu_repo->store($user, $menu);
                if (!empty($request->submenu)) {
                    foreach ($request->submenu as $data_submenu) {
                        $submenu = $this->submenu_repo->findBySubmenuId($data_submenu);
                        if ($menu->menu_id == $submenu->menu_id) {
                            $this->user_submenu_repo->store($submenu, $user_menu);
                        }
                    }
                }
            }
        }

        $this->event->fire('user.store');
        return redirect()->back();
    }

    public function show($slug)
    {
        $user = $this->user_repo->findBySlug($slug);
        return view('dashboard.user.show')->with('user', $user);
    }

    public function edit($slug)
    {
        $user = $this->user_repo->findBySlug($slug);
        return view('dashboard.user.edit')->with('user', $user);
    }

    public function update(UserFormRequest $request, $slug)
    {
        $user = $this->user_repo->update($request, $slug);
        if (!empty($request->menu)) {
            foreach ($request->menu as $data_menu) {
                $menu = $this->menu_repo->findByMenuId($data_menu);
                $user_menu = $this->user_menu_repo->store($user, $menu);
                if (!empty($request->submenu)) {
                    foreach ($request->submenu as $data_submenu) {
                        $submenu = $this->submenu_repo->findBySubmenuId($data_submenu);
                        if ($menu->menu_id === $submenu->menu_id) {
                            $this->user_submenu_repo->store($submenu, $user_menu);
                        }
                    }
                }
            }
        }
        $this->event->fire('user.update', $user);
        return redirect()->route('dashboard.user.index');
    }

    public function destroy($slug)
    {
        $user = $this->user_repo->destroy($slug);
        $this->event->fire('user.destroy', $user);
        return redirect()->back();
    }

    public function activate($slug)
    {
        $user = $this->user_repo->activate($slug);
        $this->event->fire('user.activate', $user);
        return redirect()->back();
    }

    public function deactivate($slug)
    {
        $user = $this->user_repo->deactivate($slug);
        $this->event->fire('user.deactivate', $user);
        return redirect()->back();
    }

    public function logout($slug)
    {
        $user = $this->user_repo->logout($slug);
        $this->event->fire('user.logout', $user);
        return redirect()->back();
    }

    public function resetPassword($slug)
    {
        $user = $this->user_repo->findBySlug($slug);
        return view('dashboard.user.reset_password')->with('user', $user);
    }

    public function resetPasswordPost(UserResetPasswordRequest $request, $slug)
    {
        $user = $this->user_repo->findBySlug($slug);
        if ($request->username == $this->auth->user()->username && Hash::check($request->user_password, $this->auth->user()->password)) {
            if ($user->username == $this->auth->user()->username) {
                $this->session->flash('USER_RESET_PASSWORD_OWN_ACCOUNT_FAIL', 'Please refer to profile page if you want to reset your own password.');
                return redirect()->back();
            } else {
                $this->user_repo->resetPassword($user, $request);
                $this->event->fire('user.reset_password_post', $user);
                return redirect()->route('dashboard.user.index');
            }
        }
        $this->session->flash('USER_RESET_PASSWORD_CONFIRMATION_FAIL', 'The credentials you provided does not match the current user!');
        return redirect()->back();
    }
}
