<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CekController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
            if (auth()->user()->hasRole(['admin','Petugas'])) {
                return redirect('/dashboard');
            } else {
                return redirect ('/');
            }
            

    }
}
