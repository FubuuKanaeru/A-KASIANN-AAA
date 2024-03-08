<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public $create;
    public function __invoke(Request $request)
    {
        return view('admin/user/index');
    }

    public function index(Request $request)
    {
        return view('admin/user/index');
    }

    public function create(){

        $this->create = true;
        return view('admin/user/create');
    
    }

    public function destroy($id){
        User::where('id',$id)->delete();
    }
}
