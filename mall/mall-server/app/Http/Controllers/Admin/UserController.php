<?php

namespace App\Http\Controllers\Admin;

use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController {

    public function userList() {
        $data = User::paginate($this->pageSize);
        return response()->json(Result::ok4($data));
    }
}
