@extends('layouts.main')
@section('content')
<div class="container">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="container">

                <!-- Account Logo -->
                <div class="account-logo">
                    <a href="/"><img src="assets/img/logo-FSS-marrakech.png" alt="FSMM HR" style="width: 200px" ></a>
                </div>
                <!-- /Account Logo -->

                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Login</h3>

                        <!-- Account Form -->
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Code-som</label>
                                <input id="som" type="text" class="form-control @error('som') is-invalid @enderror" name="som" value="{{ old('som') }}" required autocomplete="som">

                                    @error('som')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Password</label>
                                    </div>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit">Login</button>
                            </div>
                        </form>
                        <!-- /Account Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
