<?php

namespace App\Http\Controllers\Course\User;

use App\Http\Controllers\Controller;
use App\Services\Course\User\Service;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
