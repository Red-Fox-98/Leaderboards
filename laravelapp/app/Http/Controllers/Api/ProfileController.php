<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\CreateRequest;
use App\Models\Profile;
use App\Models\User;
use App\Transformers\ProfileTransformer;
use Illuminate\Http\Request;


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
        $data = $request->validated();

        $profile = Profile::query()->create([
            'user_id' => $user->id,
            'last_name' => $data['last_name'],
            'name' => $data['name'],
            'middle_name' => $data['middle_name'],
        ]);

        return responder()->success($profile, new ProfileTransformer())->respond();
    }
}
