@extends('layouts.cms')

@section('title'){{ $title }}@endsection



@section('content')
<div class="row">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="nav flex-column nav-pills mb-3">
                            <a href="#v-pills-general" data-bs-toggle="pill" onclick="clicknav()" class="nav-link mini-side">General</a>
                            <a href="#v-pills-notification" data-bs-toggle="pill" onclick="clicknav()" class="nav-link mini-side">Notification</a>
                            <a href="#v-pills-security" data-bs-toggle="pill" onclick="clicknav()" class="nav-link mini-side">Security</a>
                            <a href="#v-pills-generate-number" data-bs-toggle="pill" onclick="clicknav()" class="nav-link mini-side">Auto-Generated Numbers</a>
                            <a href="#v-pills-theme" data-bs-toggle="pill" onclick="clicknav()" class="nav-link mini-side">Theme</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <form action="{{ route('website.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="tab-content">
                        <div id="v-pills-general" class="tab-pane fade">
                            <div class="form-group mb-3">
                                <label for="name">Website Name : </label>
                                <input type="text" class="form-control" value="{{ $data->name??'' }}" name="name" id="name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="logo">Website Logo : </label>
                                        <br>
                                        <img src="{{ isset($data->logo) ? url($data->logo) : '' }}" width="250px" alt="No Image">
                                        <input type="file" class="form-control" name="logo" id="logo">
                                        @error('logo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="icon">Website Icon : </label>
                                        <br>
                                        <img src="{{ isset($data->icon) ? url($data->icon) : '' }}" width="150px" alt="No Image">
                                        <input type="file" class="form-control" name="icon" id="icon">
                                        @error('icon')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Website Description : </label>
                                <textarea  class="form-control" name="description" id="description" cols="30" rows="5">{{ $data->description??'' }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div id="v-pills-notification" class="tab-pane fade">
                            <div class="accordion" id="accordion-one">
                                <div class="accordion-item">
                                    <div class="accordion-header  rounded-lg" id="headingEmail" data-bs-toggle="collapse" data-bs-target="#collapseEmail" aria-controls="collapseEmail"   aria-expanded="true" role="button">
                                        <span class="accordion-header-icon"></span>
                                        <span class="accordion-header-text">Email Notification
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="notif_email" name="notif_email" value="1" {{ isset($data->notif_email) ? 'checked'  : '' }}>
                                                <label class="form-check-label" for="notif_email">{{ isset($data->notif_email) ? 'Active'  : 'Non Active' }}</label>
                                            </div>

                                        </span>
                                    </div>
                                    <div id="collapseEmail" class="collapse {{ isset($data->notif_email) ? 'show'  : '' }}" aria-labelledby="headingEmail" data-bs-parent="#accordion-one">
                                        <div class="accordion-body-text">
                                            <div class="form-group mb-3">
                                                <label for="name_sender_email">Name Sender Email : </label>
                                                <input type="text" class="form-control" value="{{ $data->name_sender_email??'' }}" name="name_sender_email" id="name_sender_email">
                                                @error('name_sender_email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="sender_email">Sender Email : </label>
                                                <input type="email" class="form-control" value="{{ $data->sender_email??'' }}" name="sender_email" id="sender_email">
                                                @error('sender_email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="password_email">Password Email : </label>
                                                <input type="password" class="form-control" value="{{ $data->password_email??'' }}" name="password_email" id="password_email">
                                                @error('password_email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-header  rounded-lg" id="headingWA" data-bs-toggle="collapse" data-bs-target="#collapseWA" aria-controls="collapseWA"   aria-expanded="true" role="button">
                                        <span class="accordion-header-icon"></span>
                                        <span class="accordion-header-text">Whatsapp Notification
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="notif_wa" name="notif_wa" value="1" {{ isset($data->notif_wa) ? 'checked'  : '' }}>
                                                <label class="form-check-label" for="notif_wa">{{ isset($data->notif_wa) ? 'Active'  : 'Non Active' }}</label>
                                            </div>

                                        </span>
                                    </div>
                                    <div id="collapseWA" class="collapse {{ isset($data->notif_wa) ? 'show'  : '' }}" aria-labelledby="headingWA" data-bs-parent="#accordion-one">
                                        <div class="accordion-body-text">
                                            <div class="form-group mb-3">
                                                <label for="name_sender_wa">Name Sender Whatsapp : </label>
                                                <input type="text" class="form-control" value="{{ $data->name_sender_wa?? '' }}" name="name_sender_wa" id="name_sender_wa">
                                                @error('name_sender_wa')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="sender_wa">No Whatsapp : </label>
                                                <input type="text" class="form-control" value="{{ $data->sender_wa?? '' }}" name="sender_wa" id="sender_wa">
                                                @error('sender_wa')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="url_api_wa">URL API : </label>
                                                <input type="password" class="form-control" value="{{ $data->url_api_wa?? '' }}" name="url_api_wa" id="url_api_wa">
                                                @error('url_api_wa')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="key_wa">API KEY : </label>
                                                <input type="password" class="form-control" value="{{ $data->key_wa?? '' }}" name="key_wa" id="key_wa">
                                                @error('key_wa')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="v-pills-security" class="tab-pane fade">
                            <div class="form-group mb-3">
                                <label for="password_min_length">Password Min Length : </label>
                                <input type="number" min="3" class="form-control" value="{{ $data->password_min_length??'' }}" name="password_min_length" id="password_min_length">
                                @error('password_min_length')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password_pattern">Password Pattern : </label>
                                @php
                                    $password_pattern = $data->password_pattern;
                                    // dd($data);
                                    $patterns = [
                                        'numeric' => 'Numeric',
                                        'symbol' => 'Symbol',
                                        'capital' => 'Capital',
                                    ];
                                @endphp
                                <select name="password_pattern[]" id="password_pattern" class="form-control select2-multiple" multiple size="3" style="height: 100%;">
                                    @foreach ($patterns as $pattern => $label)
                                        <option value="{{ $pattern }}" {{ in_array($pattern, $password_pattern) ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('password_pattern')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="max_login_attempt">Max Login Attempt : </label>
                                <input type="number" min="3" class="form-control" value="{{ $data->max_login_attempt??'' }}" name="max_login_attempt" id="max_login_attempt">
                                @error('max_login_attempt')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div id="v-pills-generate-number" class="tab-pane fade">
                            <table class="table">
                                <caption>
                                   <ol>
                                        <li>{Y} : Year</li>
                                        <li>{M} : Month</li>
                                        <li>Example : APP/{Y}/{M}/ <br> APP/{{ date('Y') }}/{{ date('m') }}/generateNumber</li>
                                   </ol>
                                </caption>
                                <thead>
                                    <tr>
                                        <th>Form</th>
                                        <th>Prefix</th>
                                        <th>Suffix</th>
                                        <th>Digits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $forms = ['opportunity', 'quotation', 'order', 'invoice', 'payment'];
                                    @endphp
                                    @foreach ($forms as $form)
                                        <tr>
                                            <td>{{ ucfirst($form) }}</td>
                                            <td>
                                                <input type="text" name="prefix[{{ $form }}]" value="{{ $data->prefix->$form ?? '' }}" class="form-control"></td>
                                            <td>
                                                <input type="text" name="suffix[{{ $form }}]" value="{{ $data->suffix->$form ?? '' }}" class="form-control"></td>
                                            <td>
                                                <input type="text" name="digits[{{ $form }}]" value="{{ $data->digits->$form ?? '' }}" class="form-control">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="v-pills-theme" class="tab-pane fade">
                            <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit nostrud magna nulla. Velit
                                et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">{{ __("Save") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('cms/vendor/select2/css/select2.min.css') }} ">
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="{{ asset('cms/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('cms/vendor/select2/js/select2.full.min.js') }}"></script>
<script>
$(document).ready(function(){
    clicknav(true);
    $(".select2-multiple").select2();

})

function clicknav(isNew = false)
{
    if(isNew){
        var oldCookie = $.cookie("activeHref");
        if (oldCookie) {
            // Find the element with a matching "href" attribute
            var matchingElement = $("a[href='" + oldCookie + "']");

            if (matchingElement.length > 0) {
                // Add the "active" class to the matching element
                matchingElement.addClass("active").addClass('show');

                $(`${oldCookie}`).addClass("active").addClass('show')
            }
        }else{
            var defaultVariable = '#v-pills-general';
            console.log(defaultVariable);
            var matchingElement = $("a[href='" + defaultVariable + "']");

            if (matchingElement.length > 0) {
                // Add the "active" class to the matching element
                matchingElement.addClass("active").addClass('show');

                $(`${defaultVariable}`).addClass("active").addClass('show')
            }
        }
    }else{
        var navContainer = $(".nav.flex-column.nav-pills.mb-3");
        var activeElement = navContainer.find(".mini-side.active");

        // Periksa apakah elemen "active" ditemukan
        if (activeElement.length > 0) {
            // Lakukan apa yang perlu Anda lakukan dengan elemen "active"
            var hrefValue = activeElement.attr("href");
            $.cookie("activeHref", hrefValue);
        } else {
            var defaultVariable = '#v-pills-general';
            console.log(defaultVariable);
            var matchingElement = $("a[href='" + defaultVariable + "']");

            if (matchingElement.length > 0) {
                // Add the "active" class to the matching element
                matchingElement.addClass("active").addClass('show');

                $(`${defaultVariable}`).addClass("active").addClass('show')
            }
        }

    }

}
</script>

@endsection
