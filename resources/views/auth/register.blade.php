@extends('layouts.frontend.index')

@section('content')
<!-- content start -->
    <div class="container-fluid p-0 home-content container-top-border">
        <!-- account block start -->
        <div class="container">
            <nav class="navbar clearfix secondary-nav pt-0 pb-0 login-page-seperator">
                <ul class="list mt-0">
                     <li><a href="{{ route('login') }}" >Login</a></li>
                     <li><a href="{{ route('register') }}" class="active">Register</a></li>
                </ul>
            </nav>

            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 vertical-align d-none d-lg-block">
                    <img class="img-fluid" src="{{ asset('frontend/img/learn.png') }}" width="500px" height="500px">
                </div>
                <div class="col-xl-6 offset-xl-0 col-lg-6 offset-lg-0 col-md-8 offset-md-2">
                    <div class="rightRegisterForm">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="registerForm">
                        {{ csrf_field() }}
                        <div class="p-4">
                            <div class="form-group">
                                <!-- <div class="row"> -->
                                    <!-- <div class="col-6"> -->
                                        <label>First Name</label>
                                        <input type="text" class="form-control form-control-sm"  value="@if(!empty($name)){{ $name }}@else{{ old('name') }}@endif" name="name"   >
                                        @if ($errors->has('name'))
                                        <label class="error" for="name">{{ $errors->first('name') }}</label>
                                        @endif
                                    <!-- </div> -->
                                    
                                <!-- </div> -->
                            </div>
                            <div class="form-group">
                                <label>Email ID</label>
                                <input type="text" class="form-control form-control-sm"  value="@if(!empty($name)){{ $email }}@else{{ old('email') }}@endif" name="email">
                                @if ($errors->has('email'))
                                <label class="error" for="email">{{ $errors->first('email') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control form-control-sm"  name="password" id="password">
                                @if ($errors->has('password'))
                                <label class="error" for="password">{{ $errors->first('password') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control form-control-sm"  name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                <label class="error" for="password_confirmation">{{ $errors->first('password_confirmation') }}</label>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="offer" name="offer" {{ old('offer') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="offer">Receive relevant offers & communications</label>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-lg btn-block login-page-button">Register</button>
                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- account block end -->
    </div>
    <!-- content end -->
@endsection

@section('javascript')
<script type="text/javascript">
$(document).ready(function()
{
    $("#registerForm").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email:{
                    required: true,
                    email:true,
                    remote: "{{ url('checkUserEmailExists') }}"
                },
                password:{
                    required: true,
                    minlength: 6
                },
                password_confirmation:{
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                first_name: {
                    required: 'The fname field is required.'
                },
                last_name: {
                    required: 'The lname field is required.'
                },
                email: {
                    required: 'The email field is required.',
                    email: 'The email must be a valid email address.',
                    remote: 'The email has already been taken.'
                },
                password: {
                    required: 'The password field is required.',
                    minlength: 'The password must be at least 6 characters.'
                },
                password_confirmation: {
                    required: 'The password confirmation field is required.',
                    equalTo: 'The password confirmation does not match.'
                }
            }
        });

});
</script>
@endsection