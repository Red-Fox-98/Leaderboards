@extends('layouts.app')

@section('content')
    @php /** @var \App\Models\Profile $profileData */ @endphp
    @if($profileData->exists)
        <form method="POST" action="{{ route('admin.profile.update', $profileData->id) }}">
            @method('PATCH')
            @else
                <form method="POST" action="{{ route('admin.profile.destroy', $profileData->id) }}">
                    @method('DELETE')
                    @endif
                    @csrf
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @include('admin.profile.editing.profile_edit_main_col')
                            </div>
                            <div class="col-md-3">
                                @include('admin.profile.editing.profile_edit_add_col')
                            </div>
                        </div>
                    </div>
                </form>

        @endsection
