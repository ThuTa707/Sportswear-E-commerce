@extends('frontend.layouts.master')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow border-0">

                    <div class="card-body">

                        <h3 class="text-bold text-cus text-center">
                            <i class="fas fa-lock"></i> Change Your Password Here
                        </h3>

                        <form action="{{route('update.password')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">
                                    Current Password
                                </label>
    
                                <input id="current_password" type="password"
                                    class="form-control @error('current_password') is-invalid @enderror" name="current_password"
                                     autofocus>
    
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    
                            </div>
    
                            <div class="form-group">
                                <label for="new_password">
                                    New Password
                                </label>
    
                                <input id="new_password" type="password"
                                    class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                                     autofocus>
    
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    
                            </div>
    
                            <div class="form-group">
                                <label for="new_confirm_password">
                                    Confirm Password
                                </label>
    
                                <input id="new_confirm_password" type="password"
                                    class="form-control @error('new_confirm_password') is-invalid @enderror"
                                    name="new_confirm_password" autofocus>
    
                                @error('new_confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    
                            </div>
    
                            <button class="btn btn-primary float-right">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                Update
                            </button>
    
        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
