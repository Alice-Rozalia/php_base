<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller {

    protected $pageSize = 10;

    public function __construct() {
        $this->pageSize = config('page.pageSize');
    }

}
