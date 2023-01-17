<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DestroyPhotoController extends BaseController
{
    public function __invoke()
    {
        $this->service->destroy();


        return redirect()->route('profile.index', auth()->user()->id);
    }
}
