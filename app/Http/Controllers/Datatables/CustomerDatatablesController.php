<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Customer;
use App\CustomerContact;
use DataTables;
class CustomerDatatablesController extends Controller
{
    public function index()
    {
        $data = Customer::query()
            ->select('customers.*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return NULL;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    
    public function getContacts(Request $request,$customer_id)
    {
        $data = CustomerContact::query()
            ->where('customer_id','=',$customer_id)
            ->select('customer_contacts.*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return NULL;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
