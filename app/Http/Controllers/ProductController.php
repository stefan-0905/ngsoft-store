<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Page that shows products, that can be filtered by searchTerm and rating, as well as sorted by possible options
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $products = \App\Product::with('category')
            ->searchByTerm(request('searchTerm'))
            ->filterByRating(request('filterRating'))
            ->sortable()
            ->sortByCategory(request('sort'), request('direction'))
            ->paginate(5);

        return view('index', ['products' => $products]);
    }

    /**
     * Page with create product form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('create', ['categories'=>\App\Category::all()]);
    }

    /**
     * Store product, and category if needed, in db
     *
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProductRequest $request) {
        if(request()->has('new_category')) {
            $newCategory = Category::create(['name' => $request->new_category]);
        }

        $myRequest = $request->except(['new_category']);

        if(isset($newCategory)) {
            $myRequest['category_id'] = $newCategory->id;
        }

        $product = Product::create($myRequest);

        if(request()->has('img')) {
            $product->update(['image' => request()->file('img')->store('images')]);
        }

        return redirect()->route('products');
    }
}
