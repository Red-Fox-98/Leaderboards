<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\CreateRequest;
use App\Models\File;
use App\Models\Profile;
use App\Models\User;
use App\Transformers\ProfileTransformer;


class ProfileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @param \App\Http\Requests\User\Profile\CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $profileData = $request->validated();
        $profile = User::find($user->id)->profile;
        $file = File::where('id', $profileData['file_id'])->first();

        if ($profile) {
            $profile->update($request->all());
        } else {
            $profile = Profile::query()->create([
                'user_id' => $user->id,
                'last_name' => $profileData['last_name'],
                'name' => $profileData['name'],
                'middle_name' => $profileData['middle_name'],
            ]);
        }
        
        $file->update(
            [
                'model_id' => $profile['id'],
                'model_type' => Profile::class
            ]
        );

        return responder()->success($profile, new ProfileTransformer())->respond();
    }
}
