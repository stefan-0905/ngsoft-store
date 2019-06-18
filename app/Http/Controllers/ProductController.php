<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = \App\Product::with('category')
            ->sortable()
            ->searchByTerm(request()->searchTerm)
            ->filterByRating(request()->filterRating)
            ->sortByCategory(request()->only(['sort', 'direction']))
            ->paginate(5);
        return view('index', ['products' => $products]);
    }

    public function create() {
        return view('create', ['categories'=>\App\Category::all()]);
    }

    public function store(CreateProductRequest $request) {
        $newProduct = Product::create($request->all());

        return redirect()->route('products');
    }
}
