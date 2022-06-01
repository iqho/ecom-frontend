@extends('layouts.app')

@section('content')
    <div id="loginForm" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }} </div>

                    <div class="card-body">
                        @{{ name }}
                        <div id="myname"></div>

                        <form method="post" action="{{ route('login2') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" v-model="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" v-model="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const {
            createApp
        } = Vue
        createApp({
            data() {
                return {
                    email: '',
                    password: '',
                    name: 'Iqbal'
                }
            },
            methods: {
                async onSubmitLoginForm() {
                    // validate user input data
                    if (this.email === '' || this.password === '') {
                        alert('email or password can\'t be empty');
                        return;
                    }

                    // send request to api server
                    const url = 'http://127.0.0.1:8000/api/login'
                    const data = {
                        email: this.email,
                        password: this.password,
                    };

                    await axios.post(url, data).then((response) => {
                        if (response.data.length !== 0) {
                            localStorage.setItem("authToken", JSON.stringify(response.data.token));
                            localStorage.setItem("userData", JSON.stringify(response.data.user));
                            window.location.href = "/login";
                        }
                    }).catch((err) => {

                    });

                }
            },

            mounted() {
                if (localStorage.getItem('authToken') !== null) {
                    let onSubmitLoginForm = document.getElementById('onSubmitLoginForm');
                    onSubmitLoginForm.style.visibility = "hidden";
                    var userName = JSON.parse(localStorage.getItem("userData"));
                    $('div#myname').text(userName.name);
                }
            }

        }).mount('#loginForm')
    </script>
@endpush


{{-- get data from login form --}}
{{-- validate input data --}}
{{-- send axios request to api server --}}
{{-- check response status 200 --}}
{{-- if response 200 then save user token and user information to localstorage --}}
{{-- redirect to the dashboard --}}
