<?php

namespace App\Services\Profile;

use App\Models\About;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function uploadPhoto($image)
    {
        try {
            DB::beginTransaction();

            $imageName = time() . '.' . $image->extension();
            if (auth()->user()->about->photoPath != 'photos/250.png') {
                Storage::disk('public')->delete(substr(auth()->user()->about->photoPath, 9));
            }

            $path = 'users/photo/user-' . auth()->user()->id;

            $image->storeAs('public/' . $path, $imageName);

            About::where('user_id', auth()->user()->id)
                ->update(['photoPath' => '/storage/' . $path . '/' . $imageName]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function destroy()
    {
        try {
            DB::beginTransaction();

            Storage::disk('public')->delete(substr(auth()->user()->about->photoPath, 9));

            auth()->user()->about->update(['photoPath' => 'photos/empty_profile.jpg']);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function update($data)
    {
        try {
            DB::beginTransaction();

            $user = User::find(auth()->user()->id);

            if (Arr::exists($data, 'name')) {
                $user->update(['name' => $data['name']]);
            }

            if (Arr::exists($data, 'surname')) {
                $user->update(['surname' => $data['surname']]);
            }

            if (Arr::exists($data, 'number')) {
                $user->about->update(['number' => $data['number']]);
            }

            if (Arr::exists($data, 'email')) {
                $user->update(['email' => $data['email']]);
            }

            if (Arr::exists($data, 'password')) {
                $user->update(['password' => Hash::make($data['password'])]);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }
}
