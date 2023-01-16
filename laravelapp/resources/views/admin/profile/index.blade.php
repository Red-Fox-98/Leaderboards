@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        {{ session()->get('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <th>#</th>
                            <th>User_id</th>
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th> </th>
                            </thead>
                            <tbody>
                            @php /** @var \App\Models\Profile $profile*/ @endphp
                            @foreach($paginator as $profile)
                                <tr class="align-middle">
                                    <td> {{ $profile->id }} </td>
                                    <td> {{ $profile->user_id }} </td>
                                    <td> {{ $profile->last_name }} </td>
                                    <td> {{ $profile->name }} </td>
                                    <td> {{ $profile->middle_name }} </td>
                                    <td>
                                        <nav class="navbar navbar-toggleable-ms navbar-light bg-faded">
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.profile.edit', $profile->id) }}">Редактировать</a>
                                        </nav>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
