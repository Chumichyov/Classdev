<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UploadPhotoRequest;

class UploadPhotoController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UploadPhotoRequest $request)
    {
        $image = $request->validated();
        $this->service->uploadPhoto($image['image']);

        return redirect()->route('profile.index', auth()->user()->id);
    }
}
