<?php

namespace App\Http\Controllers;

use App\Models\CategoryProducts;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public static function getFilters(array $request = [])
    {
        $accepts = [
            'name', 'brand_id', 'cate_id', 'quantity', 'price', 'description'
        ];
        $filters = [];

        foreach ($accepts as $col) {
            $filters[$col] = Arr::get($request, $col);
        } //end foreach

        return $filters;
    }
    private static function getProduct(array $filters = [], $limit = 10)
    {
        extract($filters);
        $data = Products::query();
        if (!is_null($name)) {
            $data->where('name', 'LIKE',  "%" . $name . "%");
        } //end if
        if (!is_null($description)) {
            $data->where('description', 'LIKE',  "%" . $description . "%");
        } //end if
        if (!is_null($cate_id)) {
            $data->where('cate_id', $cate_id);
        } //end if
        if (!is_null($quantity)) {
            $data->where('quantity', '<=', $quantity);
        } //end if
        if (!is_null($price)) {
            $data->where('price', '<=', $price);
        } //end if
        return $data->orderBy('product_id', 'desc')->paginate($limit);
    }
    private static function findProduct(int $id)
    {
        return Products::find($id);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryProducts::all();
        // dd($categories->isEmpty());
        if ($categories->isEmpty()) {
            return redirect()->route('category.show')->with('alert', 'Chưa có danh mục sản phẩm');
        }
        $compacts = [
            'categories' => $categories
        ];
        return view('web.products.index', $compacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'images' => 'required',
            'images.*' => 'mimes:png,jpg',
            'price' => 'required|numeric|between:0,9999999999.99',
            'quantity' => 'required|numeric|between:0,9999999999.99',
            'sale_price' => 'required|numeric|between:0,9999999999.99',
        ]);
        $images = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('posts/image', $name);
                $images[] = $name;
            }
        }
        $products = new Products();
        $products->cate_id = $request->cate_id;
        $products->name = $request->name;
        $products->slug = Str::slug($request->name, '-');
        $products->pro_image = json_encode($images);
        $products->description = $request->description;
        $products->quantity = $request->quantity;
        $products->price = $request->price;
        $products->sale_price = $request->sale_price;
        $products->save();

        return redirect()->route('product.list')->with('success', 'Thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products, Request $request)
    {
        $user = Auth::user();
        $status = json_decode($user->is_active, true);
        // dd($status);
        if ($user->role == 1 || isset($status['add'])) {
            $filters = self::getFilters($request->toArray());
            $categories = CategoryProducts::with('products')->latest()->get();
            $compacts = [
                "products" => self::getProduct($filters),
                "filters" => $filters,
                "categories" => $categories
            ];
            return view('web.products.list', $compacts);
        }
        return redirect()->back()->with('alert', 'Bạn chưa được cấp quyền chỉnh sửa');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products, int $id)
    {
        $user = Auth::user();
        $status = json_decode($user->is_active, true);
        if ($user->role == 1 || isset($status['edit'])) {
            $product = self::findProduct($id);
            if (!$product) {
                abort(404);
            } //end if
            $categories = CategoryProducts::with('products')->latest()->get();
            $compacts = [

                "categories" => $categories,
                'products' => $product
            ];
            return view('web.products.detail', $compacts);
        }
        return redirect()->back()->with('alert', 'Bạn chưa được cấp quyền chỉnh sửa');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products, int $id)
    {
        $user = auth()->user()->role;
        if ($user != 1) {

            return redirect()->back()->with('alert', 'Bạn chưa được cấp quyền chỉnh sửa');
        }
        // dd(auth()->user());
        $product = self::findProduct($id);

        if (!$product) {
            abort(404);
        } //end if
        $this->validate($request, [
            'name' => 'required',
            'images' => 'required',
            'images.*' => 'mimes:png,jpg',
            'price' => 'required|numeric|between:0,9999999999.99',
            'quantity' => 'required|numeric|between:0,9999999999.99',
            'sale_price' => 'required|numeric|between:0,9999999999.99',
        ]);
        $images = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('posts/image', $name);
                $images[] = $name;
            }
        }
        $product->cate_id = $request->cate_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->pro_image = json_encode($images);
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->save();

        return redirect()->route('product.list')->with('success', 'Thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products, int $id)
    {
        $user = Auth::user();
        $status = json_decode($user->is_active, true);
        if ($user->role == 1 || isset($status['delete'])) {
            DB::table('products')->where('product_id', $id)->delete();
            return redirect()->route('product.list')->with('success', 'Thành công');
        }
        return redirect()->back()->with('alert', 'Bạn chưa được cấp quyền chỉnh sửa');
    }
}
