@php
    /** @var \App\Models\Profile $profileData */
@endphp
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.profile.update', $profileData->id) }}">
                @method('PATCH')
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
            <br>
            <form method="POST" action="{{ route('admin.profile.destroy', $profileData->id) }}">
                @method('DELETE')
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger">Удалить</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
