<?php

namespace App\Http\Controllers\Select2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Customer;

class CustomerSelect2Controller extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = Customer::query()
                ->where('name','LIKE',"%$search%")
                ->paginate(5);
        }
        else{
            $data = Customer::paginate(5); 
        }
        return response()->json($data);
    }
}
