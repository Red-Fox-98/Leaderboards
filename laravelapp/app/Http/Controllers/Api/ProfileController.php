<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\CreateRequest;
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
        dd('dfghjkl');
        /** @var User $user */
        $user = auth()->user();
        $profileData = $request->validated();
        $profile = Profile::where('user_id', $user->id)->first();

        if($profile){
            $profile->update($request->all());
        }else{
            $profile = Profile::query()->create([
                'user_id' => $user->id,
                'last_name' => $profileData['last_name'],
                'name' => $profileData['name'],
                'middle_name' => $profileData['middle_name'],
            ]);
        }

        return responder()->success($profile, new ProfileTransformer())->respond();
    }
}
