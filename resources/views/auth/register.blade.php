@extends('layouts.app')

@section('content')
    <div class="container" id="registerForm">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">

                        <form @submit.prevent="onSubmitRegisterForm" id="onSubmitRegisterForm">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" v-model="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" v-model="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

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
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" v-model="passwordConfirm" type="password"
                                        class="form-control" name="password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                            </div> --}}

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
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
                    name: '',
                    email: '',
                    password: '',
                    // passwordConfirm: ''
                }
            },
            methods: {
                async onSubmitRegisterForm() {
                    // validate user input data
                    if (this.email === '' || this.password === '') {
                        alert('email or password can\'t be empty');
                        return;
                    }

                    // send request to api server
                    const url = 'http://127.0.0.1:8000/api/register'
                    const data = {
                        name: this.name,
                        email: this.email,
                        password: this.password
                    };

                    await axios.post(url, data).then((response) => {
                        if (response.data.length !== 0) {
                            localStorage.setItem("authToken", JSON.stringify(response.data.token));
                            localStorage.setItem("userData", JSON.stringify(response.data.user));
                            window.location.reload();
                        }
                    }).catch((err) => {

                    });

                }
            },

            mounted() {
                if (localStorage.getItem('authToken') !== null) {
                    let onSubmitRegisterForm = document.getElementById('onSubmitRegisterForm');
                    onSubmitRegisterForm.style.display = "none";
                    //console.log(localStorage.getItem('userData'));
                }
            }

        }).mount('#registerForm')
    </script>
@endpush
