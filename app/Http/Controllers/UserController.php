<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public static function getFilters(array $request = [])
    {
        $accepts = [
            'name', 'email', 'is_active'
        ];
        $filters = [];

        foreach ($accepts as $col) {
            $filters[$col] = Arr::get($request, $col);
        } //end foreach

        return $filters;
    }
    private static function getUsers(array $filters = [], $limit = 10)
    {
        extract($filters);
        $data = User::query();
        if (!is_null($name)) {
            $data->where('name', 'LIKE',  "%" . $name . "%");
        } //end if
        if (!is_null($email)) {
            $data->where('email', 'LIKE',  "%" . $email . "%");
        } //end if

        if (!is_null($is_active) && in_array($is_active, User::ROLES_ARR)) {
            $data->where('is_active', $filters['is_active']);
        } //end if
        return $data->orderBy('id', 'desc')->paginate($limit);
    }

    private static function findUser(int $id)
    {
        return User::find($id);
    }

    public function index(Request $request)
    {
        $filters = self::getFilters($request->toArray());
        $compacts = [
            'siteTitle' => 'Danh sách người dùng',
            "users" => self::getUsers($filters),
            "filters" => $filters,
            "is_active" => User::ROLES,
        ];

        return view('web.users.index', $compacts);
    }
    public function change(Request $request,int $id)
    {
        if (empty($request->product) && empty($request->customer)) {
            return redirect()->back()->with('alert', 'Bạn cần chọn tính năng cho người dùng sử dụng');
        }
        $dataIsActive = array();
        $dataModule = array();
        // dd($request->all(),array_values($status));
        $dataIsActive = ['add'=>$request->add,'edit'=>$request->edit,'delete'=>$request->delete];
        $dataModule = ['product'=>$request->product,'customer'=>$request->customer];
        // dd($dataIsActive,$dataModule);
        $user = auth()->user()->role;
        if ( $user != 1 ) {
            return redirect()->back()->with('alert', 'Bạn chưa được cấp quyền chỉnh sửa');
        }
        $user = self::findUser($id);
        if($user) {
            $user->is_active = json_encode($dataIsActive);
            $user->module =json_encode($dataModule);
            $user->save();
            return redirect()->route('users')->with('success', 'Thành công');
        }
    }
    public function delete(int $id)
    {

    }
}
