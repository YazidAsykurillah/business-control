<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use DataTables;
class UserDatatablesController extends Controller
{
    public function index()
    {
        $data = User::query()
        ->with([
            'roles'=>function($query){
                return $query->select('roles.id','roles.name');
            }
        ])
        ->select('users.*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    //$btn = '<a href="javascript:void(0)" class="btn btn-primary btn-xs btn-edit">Edit</a>';
                    return NULL;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
