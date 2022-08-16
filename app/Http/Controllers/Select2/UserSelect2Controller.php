<?php

namespace App\Http\Controllers\Select2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
class UserSelect2Controller extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = User::query()
                ->where('name','LIKE',"%$search%")
                ->orWhere('code','LIKE',"%$search%")
                ->paginate(5);
        }
        else{
            $data = User::paginate(5); 
        }
        return response()->json($data);
    }
}
