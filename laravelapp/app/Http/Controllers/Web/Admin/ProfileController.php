<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\ProfileRepository;
use App\Http\Requests\Profile\Admin\UpdateRequest;
use Illuminate\Database\Eloquent\Model;

class ProfileController extends Controller
{
    public function __construct(private ProfileRepository $profileRepository)
    {
    }

    public function index()
    {
        $paginator = $this->profileRepository->getAllWithPaginate(25);
        return view('admin.profile.index', compact('paginator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $profileData = $this->profileRepository->getEdit($id);

        if (empty($profileData)) {
            abort(404);
        }

        return view('admin.profile.edit', compact('profileData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Profile\Admin\UpdateRequest $request
     * @param int $id
     */
    public function update(UpdateRequest $request, $id)
    {
        $profileData = $this->profileRepository->getEdit($id);
        if (empty($profileData)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }
        $profileData->update($request->validated());
        if ($profileData) {
            return redirect()
                ->route('admin.profile.index', $profileData->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка соединения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $profile = Profile::find($id)->first();
        $user = User::where('id', $profile['user_id'])->first();
        /** @var $token */
        foreach ($user->tokens as $token) {
            if($token->tokenable_id == $user->id){
                $token->forceDelete();
            }
        }
        $profile->forceDelete();$user->forceDelete();
        if ($user) {
            return redirect()
                ->route('admin.profile.index')
                ->with(['success' => "Запись id[$id] удалена"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
