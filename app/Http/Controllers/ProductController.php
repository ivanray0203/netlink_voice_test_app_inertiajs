<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Product\Store;
use App\Http\Requests\Product\Update;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    
    {
        $search = $request->input('search');
        $with_stocks = $request->input('with_stocks');

        $products = Product::when($request->has('search'), function ($query) use ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        })
        ->when(!$request->has('with_stocks'), function ($query) use ($with_stocks) {
            $query->where('quantity', '>', 0 );
        })
        ->when($with_stocks == "true", function ($query) use ($with_stocks) {
            $query->where('quantity', '>', 0 );
        })
        ->when($with_stocks == "false", function ($query) use ($with_stocks) {
            $query->where('quantity', '<', 1 );
        })
        ->get();

        return Inertia::render('Products/Index', [
            'products' => ProductResource::collection($products),
            'search' => $request->only('search'),
            'with_stocks' => $request->only('with_stocks')
        ]);
    }

    public function createProduct(Request $request)
    {   
        return Inertia::render('Products/Create', [
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    public function storeProduct(Store $request)
    {
        try {
            $data = collect($request->validated())->toArray();
            $product = Product::create($data);
            return redirect('/products');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateProduct(Update $request, $id)
    {
        try {
            $data = collect($request->validated())
            ->except(['id'])
            ->toArray();
            $product = Product::findOrFail($id);
            $product->update($data);
            return redirect('/products');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function showProduct($id)
    {
        $product = Product::findOrFail($id);
        return Inertia::render('Products/Edit', [
            'categories' => CategoryResource::collection(Category::all()),
            'product' => new ProductResource($product)
        ]);
    }

    public function deleteProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect('/products');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
