<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $productCount = Product::count();
        $products = Product::all();
        $showorder = Order::count();
        $orders = Order::all();

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

        return view('dashboard.index', compact('users','productCount', 'products', 'showorder', 'orders', 'totalOrderPriceFormatted'));
    }
}
