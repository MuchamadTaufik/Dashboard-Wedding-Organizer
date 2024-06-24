<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ShowProductlist(){
        $product = Product::all();
        $user = User::all();
        $order = Order::all();
        return view('pages.tables', compact('product','user','order'));
    }

    public function ShowOrder(){
        $order = Order::all();
        // Retrieve total_price values from the database
        $totalPrices = DB::table('orders')->pluck('total_price');

        // Remove non-numeric characters and convert to decimal
        $cleanedTotalPrices = collect($totalPrices)->map(function ($value) {
            return (float) str_replace(['Rp', '.', ','], '', $value);
        });

        // Sum the cleaned values
        $totalOrderPrice = $cleanedTotalPrices->sum();

        // Format the result as Rp
        $totalOrderPriceFormatted = 'Rp ' . number_format($totalOrderPrice, 0, ',', '.');
        return view('pages.billing', compact('order','totalOrderPriceFormatted'));
    }
    
    public function index()
    {
        return view('pages.tables',[
            'orders' => Order::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.order.create',[
            'products' => Product::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'date' => 'required',
            'products_id' => 'required',
            'amount' => 'required',
            'total_price' => 'required'
        ]);

        $products = Product::find($validatedData['products_id']);

        if (!$products) {
            return redirect('/tables')->with('error', 'Barang yang dipilih tidak ada.');
        }

        if ($validatedData['amount'] > $products->stock) {
            return redirect('/tables')->with('error', 'Jumlah keluarnya melebihi jumlah barang.');
        }

        if ($products) {
            $products->update([
                'stock' => $products->stock - $validatedData['amount']
            ]);
        }

        Order::create($validatedData);

        return redirect('/tables')->with('success', 'Order Berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view ('pages.tables',[
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view ('pages.order.edit',[
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'date' => 'required',
            'products_id' => 'required',
            'amount' => 'required|integer|min:1|max:' . $this->getAvailableStock($request->input('products_id')),
            'total_price' => 'required'
        ]);

        $products = Product::find($validatedData['products_id']);

        if (!$products) {
            return redirect('/order')->with('error', 'Barang yang dipilih tidak ada.');
        }

        if ($validatedData['amount'] > $products->stock) {
            return redirect('/order')->with('error', 'Jumlah keluarnya melebihi jumlah barang.');
        }

        if ($products) {
            $products->update([
                'stock' => ($products->stock + $order->amount) - $validatedData['amount']
            ]);
        }

        Order::where('id', $order->id)->update($validatedData);

        return redirect('/tables')->with('success','Order Berhasil diperbarui!');
    }

    // Mendapatkan stok yang tersedia
        private function getAvailableStock($productId)
        {
            $product = Product::findOrFail($productId);
            return $product->stock;
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $products = Product::find($order->id);

        if ($products) {
            $products->update([
                'stock' => $products->stock + $order->amount
            ]);
        }

        Order::destroy($order->id);

        return redirect('/tables')->with('success','Order Berhasil dihapus');
    }
}
