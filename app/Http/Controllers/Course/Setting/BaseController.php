<?php

namespace App\Http\Controllers\Course\Setting;

use App\Http\Controllers\Controller;
use App\Services\Course\Setting\Service;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
