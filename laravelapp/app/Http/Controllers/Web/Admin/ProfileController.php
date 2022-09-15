<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\ProfileRepository;
use App\Http\Requests\Profile\Admin\UpdateRequest;

class ProfileController extends Controller
{
    /** @var ProfileRepository */
    private $profileRepository;

    public function __construct()
    {
        parent::__construct();
        $this->profileRepository = app(ProfileRepository::class);
    }

    public function index()
    {
        $paginator = $this->profileRepository->getAllWithPaginate(25);
        return view('admin.profile.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        foreach ($user->tokens as $token) {
            if($token['tokenable_id'] == $user['id']){
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
