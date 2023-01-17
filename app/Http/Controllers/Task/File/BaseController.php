<?php

namespace App\Http\Controllers\Task\File;

use App\Http\Controllers\Controller;
use App\Services\Task\File\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
