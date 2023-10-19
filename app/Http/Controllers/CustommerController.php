<?php

namespace App\Http\Controllers;

use App\Models\Custommer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CustommerController extends Controller
{
    public static function getFilters(array $request = [])
    {
        $accepts = [
            'name', 'email', 'phone',
            'city', 'district',  'specific_address',
        ];
        $filters = [];

        foreach ($accepts as $col) {
            $filters[$col] = Arr::get($request, $col);
        } //end foreach

        return $filters;
    }
    private static function getCustomers(array $filters = [], $limit = 10)
    {
        extract($filters);
        $data = Custommer::query();
        if (!is_null($name)) {
            $data->where('name', 'LIKE',  "%" . $name . "%");
        } //end if
        if (!is_null($email)) {
            $data->where('email',  $email);
        } //end if
        if (!is_null($phone)) {
            $data->where('phone',  $phone);
        } //end if
        if (!is_null($city)) {
            $data->where('city', 'LIKE',  "%" . $city . "%");
        } //end if
        if (!is_null($district)) {
            $data->where('district', 'LIKE',  "%" . $district . "%");
        } //end if

        return $data->orderBy('id', 'desc')->paginate($limit);
    }
    private static function findCustomer(int $id)
    {
        return Custommer::find($id);
    }
    public function index(Request $request)
    {
        $filters = self::getFilters($request->toArray());
        $compacts = [
            'siteTitle' => 'Danh sách khách hàng',
            "customers" => self::getCustomers($filters),
            "filters" => $filters,
            "customer_status" => Custommer::STATUSES,
        ];

        return view('web.customers.index', $compacts);
    }
    public function create()
    {
        $user = Auth::user();
        $status = json_decode($user->is_active, true);
        // dd($status);
        if ($user->role == 1 || isset($status['add'])) {
            $compacts = [
                'siteTitle' => 'Thêm khách hàng',
                'form_data' => new Custommer()
            ];
            return view('web.customers.edit', $compacts);
        }
        return redirect()->back()->with('alert', 'Bạn chưa được cấp quyền chỉnh sửa');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone'  => 'required|numeric|digits:10',
            // 'password_confirm' => 'required|same:password'
        ]);

        $customer = new Custommer();

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->city = $request->city;
        $customer->district = $request->district;
        $customer->specific_address = $request->city . '' . $request->district . '' . $request->specific_address;
        if ($request->created_at) {
            $customer->created_at = $request->created_at;
        } //end if

        $customer->save();

        return redirect()->route('customers')->with('success', 'Thành công');
    }
    public function edit(int $id)
    {
        $user = Auth::user();
        $status = json_decode($user->is_active, true);
        if ($user->role == 1 || isset($status['edit'])) {
            $customer = self::findCustomer($id);
            if (!$customer) {
                abort(404);
            } //end if
            $compacts = [
                'siteTitle' => " Cập nhập thông tin khách hàng ",
                'form_data' => $customer
            ];
            return view('web.customers.edit', $compacts);
        }
        return redirect()->back()->with('alert', 'Bạn chưa được cấp quyền chỉnh sửa');
    }
    public function update(int $id, Request $request)
    {

        $posts = self::findCustomer($id);

        if (!$posts) {
            abort(404);
        } //end if

        $posts->name = $request->name;
        $posts->email = $request->email;
        $posts->phone = $request->phone;
        $posts->city = $request->city;
        $posts->district = $request->district;
        $posts->specific_address = $request->specific_address . '' . $request->district . '' . $request->city;
        if ($request->created_at) {
            $posts->created_at = $request->created_at;
        }
        $posts->save();
        return redirect()->route('customers')->with('success', 'Thành công');
    }
    public function change(int $id)
    {
        $customer = self::findCustomer($id);
        if ($customer) {
            $customer->status = 1;
            $customer->save();
            return redirect()->route('customers')->with('success', 'Thành công');
        }
    }
    public function show(int $id)
    {
        $customer = self::findCustomer($id);
        $compacts = [
            'customer' => $customer
        ];
        return view('web.customers.sendmail', $compacts);
    }
    public function cancel(int $id)
    {
        $user = Auth::user();
        $status = json_decode($user->is_active, true);
        if ($user->role == 1 || isset($status['delete'])) {
            $customer = self::findCustomer($id);
            if ($customer) {
                $customer->status = 2;
                $customer->save();
                return redirect()->route('customers')->with('success', 'Thành công');
            }
        }
    }
}
