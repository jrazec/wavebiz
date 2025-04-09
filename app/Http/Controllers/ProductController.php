<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\AuditLog;

class ProductController extends Controller
{
    
    public function index()
    {
        return Product::where('fldIsDeleted', 0)->get();
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        $this->logAction('create', $product, null, $product);

        return response()->json(['message' => 'Product added successfully']);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $oldValue = $product->toArray();

        $product->update($request->all());
        $newValue = $product->toArray();

        $this->logAction('update', $product, $oldValue, $newValue);

        return response()->json(['message' => 'Product updated successfully']);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $oldValue = $product->toArray();

        $product->update(['fldIsDeleted' => 1]);
        $this->logAction('delete', $product, $oldValue, $product->toArray());

        return response()->json(['message' => 'Product soft deleted']);
    }

    private function logAction($action, $product, $oldValue, $newValue)
    {
        AuditLog::create([
            'fldUserID' => 74, // TODO: To replace pa ito with the logged in user ID
            'fldAction' => $action,
            'fldTableName' => 'products',
            'fldRecordID' => $product->fldID,
            'fldOldValue' => json_encode($oldValue),
            'fldNewValue' => json_encode($newValue),
        ]);
    }
    
    
}
