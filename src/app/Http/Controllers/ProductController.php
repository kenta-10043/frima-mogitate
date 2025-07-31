<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSeason;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }

    public function register()

    {
        return view('register');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'image' => $data['image'],
            'description' => $data['description'],
        ]);
        $imagePath = $request->file('image')->store('products', 'public');

        $product->seasons()->attach($data['seasons']);

        return redirect(Route('index'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        if ($request->filled('keyword')) {

            $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->paginate(6)->appends($request->all());
            return view('index', compact('products', 'keyword'));
        }
        $products = Product::paginate(6);
        return view('index', compact('products', 'keyword'));
    }
}
