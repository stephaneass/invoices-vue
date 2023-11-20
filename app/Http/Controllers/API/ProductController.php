<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();

        return response()->json([
            'products' => $products
        ]);
    }

    function store(Request $request)
    {
        try {
            
            $invoiceData['sub_total'] = $request->input('sub_total');
            $invoiceData['total'] = $request->input('total');
            $invoiceData['discount'] = $request->input('discount');
            $invoiceData['reference'] = $request->input('reference');
            $invoiceData['date'] = $request->input('date');
            $invoiceData['due_date'] = $request->input('due_date');
            $invoiceData['number'] = $request->input('number');
            $invoiceData['customer_Id'] = $request->input('customer_id');
            $invoiceData['terms_and_conditions'] = $request->input('terms_and_conditions');

            $invoice = Invoice::create($invoiceData);

            $items = json_decode($request->invoice_items);

            foreach($items as $item){
                $itemData['product_id'] = $item->id;
                $itemData['invoice_id'] = $invoice->id;
                $itemData['quantity'] = $item->quantity;
                $itemData['unit_price'] = $item->unit_price;

                InvoiceItem::create($itemData);
            }

            return response()->json([
                'success' => true,
                'message' => 'Operation succeed'
            ]);
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Operation failed'
            ]);
        }
    }
}
