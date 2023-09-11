@php /** @var \App\Models\Profile $profileData */ @endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="last_name">Фамилия</label>
                            <input name="last_name" value="{{ $profileData->last_name }}"
                                   id="last_name"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input name="name" value="{{ $profileData->name }}"
                                   id="name"
                                   type="text"
                                   class="form-control"
                                   minlength="2"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">Отчество</label>
                            <input name="middle_name" value="{{ $profileData->middle_name }}"
                                   id="middle_name"
                                   type="text"
                                   class="form-control"
                                   required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
