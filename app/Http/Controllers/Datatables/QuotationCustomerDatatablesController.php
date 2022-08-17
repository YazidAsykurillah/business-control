<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\QuotationCustomer;
use App\QuotationCustomerItem;
use DataTables;

class QuotationCustomerDatatablesController extends Controller
{
    public function index()
    {
        $data = QuotationCustomer::query()
        ->with(
            [
                'customer'=>function($query){
                    return $query->select('customers.id','customers.name');
                }
            ]
        )
        ->with(
            [
                'preparator'=>function($query){
                    return $query->select('users.id','users.name');
                }
            ],
        )
        ->select('quotation_customers.*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return NULL;
                })
                ->rawColumns(['action'])
                ->make(true);
    }


    public function getItems($quotation_customer_id)
    {
        $data = QuotationCustomerItem::query()
            ->where('quotation_customer_id','=',$quotation_customer_id)
            ->select('quotation_customer_items.*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return NULL;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    
}
