<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationCustomer extends Model
{
    protected $table='quotation_customers';
    protected $guarded=['id'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function preparator()
    {
        return $this->belongsTo('App\User','preparator_id');
    }
    
    public function quotation_customer_items()
    {
        return $this->hasMany('App\QuotationCustomerItem');
    }
}
