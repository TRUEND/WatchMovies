@extends('layouts.app')

@section('content')

    <div class="container mt-5 pt-5">
    <!--profile update form-->
    <form method="post" action="/profile/{{$User->nickname}}" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
            <div class="row">
                <div class="col-md-2">
                    <!--Image profile-->
                    <div class="position-relative">
                        
                    <img class="w-100 rounded-top mt-2" src="{{"/storage/".$User->profile_image ?? '/storage/profile/images/default.jpeg'}}">

                        <label class="btn btn-warning w-100 rounded-0 rounded-bottom @error('profile_image')
                        btn-danger @enderror" for="profile_image">Change</label>
                        
                        <input id="profile_image" type="file" name="profile_image" 
                        class=" @error('profile_image') is-invalid @enderror"
                        style="visibility:hidden; position:absolute;">
                        
                        
                        @error('profile_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-row">
                        
                        <div class="col-md-4 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" name="firstName" class="form-control  @error('firstName') is-invalid 
                            @enderror" id="firstName" value="{{ old('firstName')}}"  placeholder="{{$User->firstName}}"  autofocus>
                        
                            @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" name="lastName" class="form-control @error('lastName') is-invalid 
                        @enderror" id="lastName" value="{{ old('lastName')}}" placeholder="{{$User->lastName}}"  autofocus>
                        
                            @error('lastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="nickname">Nickname</label>
                            <input type="text" name="nickname" class="form-control @error('nickname') is-invalid 
                        @enderror" id="nickname" value="{{ old('nickname')}}" placeholder="{{$User->nickname}}"  autofocus>
                        
                            @error('nickname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        
                    </div>
                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                            <label for="nickname">E-mail</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid 
                        @enderror" id="email" value="{{ old('email')}}" placeholder="{{$User->email}}"  autofocus>
                        
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        
                        <div class="col-md-12 mb-3">
                            <label for="nickname">Description</label>
                            
                            <textarea name="description" class="form-control @error('description') is-invalid 
                            @enderror" id="validationTextarea" placeholder="Describe yourself ..." 
                            value="{{ old('description') ?? $User->description }}"></textarea>
                            
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="form-group">
                       
                        <button class="btn btn-success d-block ml-auto" type="submit">Update</button>
        
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
