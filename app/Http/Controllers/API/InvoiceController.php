<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
}
