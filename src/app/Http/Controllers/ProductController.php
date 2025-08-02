<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
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
        $imagePath = $request->file('image')->store('products', 'public');
        $data['image'] = $imagePath;

        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'image' => $data['image'],
            'description' => $data['description'],
        ]);


        $product->seasons()->attach($data['seasons']);

        return redirect(route('index'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $sort = $request->input('sort', '');

        $query = Product::query();

        if ($request->filled('keyword')) {

            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        switch ($sort) {
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
        }

        $products = $query->paginate(6)->appends($request->all());
        return view('index', compact('products', 'keyword', 'sort'));
    }

    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $allSeasons = Season::all();
        return view('show', compact('product', 'allSeasons'));
    }

    public function update(ProductRequest $request, $productId)
    {

        $product = Product::findOrFail($productId);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }
        $product->update($data);

        return redirect(route('index'));
    }
    public function destroy(Request $request, $productId)
    {
        Product::findOrFail($productId)->delete();
        return redirect(route('index'));
    }
}
