<?php

namespace App\Http\Controllers\Course\Grade;

use App\Http\Controllers\Controller;
use App\Services\Course\Grade\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
