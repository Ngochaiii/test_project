<?php

namespace App\Http\Controllers;

use App\Models\CategoryProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cates = CategoryProducts::paginate(10);
        $compacts = [
            'cates' => $cates,
        ];
        return view('web.cate_products.index', $compacts);
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
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $cate = new CategoryProducts();
        $cate->name = $request->name;
        $cate->note = $request->note;
        $cate->save();

        return redirect()->route('category')->with('success', 'Thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category_Products  $category_Products
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProducts $category_Products)
    {
        $user = Auth::user();
        $status = json_decode($user->is_active, true);
        // dd($status);
        if ($user->role == 1 || isset($status['add'])) {
            return view('web.cate_products.create');
        }
        return redirect()->back()->with('alert', 'Bạn chưa được cấp quyền chỉnh sửa');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category_Products  $category_Products
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProducts $category_Products, int $id)
    {
        $user = Auth::user();
        $status = json_decode($user->is_active, true);
        if ($user->role == 1 || isset($status['edit'])) {
            $dataCate = CategoryProducts::where('cate_id', $id)->first();
            $compacts = [
                'dataCate' => $dataCate
            ];
            return view('web.cate_products.detail', $compacts);
        }
        return redirect()->back()->with('alert', 'Bạn chưa được cấp quyền chỉnh sửa');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category_Products  $category_Products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryProducts $category_Products, int $id)
    {
        // dd($request->all());
        $dataCate = CategoryProducts::where('cate_id', $id)->first();

        if (!$dataCate) {
            abort(404);
        } //end if
        $accepts = [
            'name',
            'note',
        ];

        foreach ($accepts as $col) {
            if ($dataCate->$col != $request->$col) {
                $dataCate->$col = $request->$col;
            } //end if
        } //end foreach

        $dataCate->save();
        return redirect()->route('category')->with('success', 'Thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category_Products  $category_Products
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryProducts $category_Products, int $id)
    {
        $user = Auth::user();
        $status = json_decode($user->is_active, true);
        if ($user->role == 1 || isset($status['delete'])) {
            DB::table('category_products')->where('cate_id', $id)->delete();
            return redirect()->route('category')->with('success', 'Thành công');
        }
        return redirect()->back()->with('alert', 'Bạn chưa được cấp quyền chỉnh sửa');
    }
}
