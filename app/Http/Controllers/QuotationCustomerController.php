<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreQuotationCustomerRequest;

use App\Library\Services\QuotationCustomerService;

use App\QuotationCustomer;

class QuotationCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('quotation-customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotation-customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuotationCustomerRequest $request)
    {
        $response=[];

        try {
            $code = config('bitpro.qc_prefix').'_'.time();

            $quotation_customer = new QuotationCustomer;
            $quotation_customer->code = $code ;
            $quotation_customer->customer_id = $request->customer_id;
            $quotation_customer->date = $request->date;
            $quotation_customer->validation_date = $request->validation_date;
            $quotation_customer->description_of_work = $request->description_of_work;
            $quotation_customer->preparator_id =\Auth::user()->id;
            $quotation_customer->discount_amount =preg_replace('#[^0-9.]#', '', $request->discount_amount);
            $quotation_customer->total_quotes =preg_replace('#[^0-9.]#', '', $request->total_quotes);
            $quotation_customer->save();

            //register quotation customer items
            $quotation_customer_items=[];
            if($request->has('item_name')){
                foreach($request->item_name as $key=>$value){
                    if($request->item_name[$key] !=NULL){
                        $quotation_customer_items[] = [
                            'name'=>$request->item_name[$key],
                            'quantity'=>preg_replace('#[^0-9.]#', '', $request->quantity[$key]),
                            'unit'=>$request->unit[$key],
                            'unit_price'=>preg_replace('#[^0-9.]#', '', $request->unit_price[$key]),
                            'amount'=>preg_replace('#[^0-9.]#', '', $request->amount[$key]),
                        ];
                    }
                }
            }
            if(count($quotation_customer_items)){
                QuotationCustomerService::registerQuotationCustomerItems($quotation_customer->id,$quotation_customer_items);
            }


            $response['status'] = TRUE;
            $response['message'] = 'Quotation customer has been saved';
            $response['data']['url'] = url('quotation-customer');
            
        } catch (Exception $e) {
            
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quotation_customer = QuotationCustomer::findOrFail($id);
        return view('quotation-customer.show')
                ->with('quotation_customer',$quotation_customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
