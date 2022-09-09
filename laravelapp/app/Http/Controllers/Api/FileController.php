<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use App\Models\File;
use App\Models\Profile;
use App\Models\User;

class FileController extends Controller
{
    /**
     * @param \App\Http\Requests\FileUploadRequest $request
     */
    public function upload(FileUploadRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $file = $request->validated();

        if ($file = $request->file('file')) {

            $data = File::query()->create([
                'user_id' => $user->id,
                'model_id' => User::find($user->id)->profile->id,
                'model_type' => Profile::class,
                'name' => $file->getClientOriginalName(),
                'path' => $request->file('file')->store('public/files'),
                'size' => $file->getSize(),
            ]);

            return $data;
        }
    }
}
