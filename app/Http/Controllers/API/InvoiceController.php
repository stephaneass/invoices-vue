<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->s;
        $invoices = Invoice::with('customer')
                        ->when(!blank($search), function($query) use($search){
                            $query->where(function($query) use($search){
                                $query->where("invoices.id", 'like', "%$search%")
                                    ->orWhere("invoices.number", 'like', "%$search%")
                                    //->where("customers.last_name", 'like', "%$search%")
                                    ;
                            });
                        })->orderBy('id', 'DESC')->get();

        return response()->json([
            'invoices' => $invoices
        ], 200);
    }

    public function create()
    {
        $counter = Counter::where('key', 'invoice')->first();
        $random = Counter::where('key', 'invoice')->first();

        $invoice = Invoice::orderBy('id', 'DESC')->first();

        if (!blank($invoice)) {
            $invoice = $invoice->id + 1;
            $counters = $counter->value + $invoice;
        } else {
            $counters = $counter->value;
        }

        $formData = [
            'number' => $counter->prefix.$counters,
            'customer_id' => null,
            'customer' => null,
            'date' => date('Y-m-d'),
            'due_date' => null,
            'reference' => null,
            'discount' => 0,
            'terms_and_conditions' => "Default term and conditions",
            'items' => [
                'product_id' => null,
                'product' => null,
                'unit_price' => 0,
                'quantity' => 1,
            ]
        ];

        return response()->json($formData);
    }

    public function show($id)
    {dd($id);
        $invoice = Invoice::with('customer')->find($id);

        return response()->json([
            'invoice' => $invoice
        ], 200);
    }
}
