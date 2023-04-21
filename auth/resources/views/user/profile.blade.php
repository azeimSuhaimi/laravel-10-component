@extends('layouts.app')

@section('title', 'change password page')
 
@section('content')

@include('partials.popup')

<div class="row">
    <div class="col-sm-4">
            <div class="card">
                <h5 class="card-header">edit users profile</h5>
                <div class="card-body">
                <h5 class="card-title">profile users</h5>

                
                    
                <img src="assets/profiles/{{ auth()->user()->picture }}" alt="..." class="img-thumbnail img-fluid rounded-circl">
                
                <form action="{{route('user.profile_image')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="file" id="file-input">
                      <label class="custom-file-label"  for="file-input">Choose file</label>

                        @error('file')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror

                    </div>
                  </div>

                  <img id="image-preview" class="img-thumbnail img-fluid" src="no-image.jpg" alt="No image selected" style="display:none;">

                  <button type="submit" class="btn btn-primary">edit</button>
                </form>

                </div>
            </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <h5 class="card-header">edit users profile</h5>
            <div class="card-body">
              <h5 class="card-title">profile users</h5>
              
              <form action="{{route('user.edit_profile')}}" method="post">
                @csrf
                  <div class="form-group">
                    <label for="name">Current name</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" name="name" value="{{$errors->has('name') ? old('name') : auth()->user()->name }}" id="name" placeholder="Current name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="email">Current email</label>
                    <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' :''}}" name="email" value="{{ $errors->has('email') ? old('email') : auth()->user()->email }}" id="email" placeholder="Current email">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="phone">Current phone</label>
                    <input type="tel" class="form-control {{$errors->has('phone') ? 'is-invalid' :''}}" name="phone" value="{{ $errors->has('phone') ? old('phone') : auth()->user()->phone }}" id="phone" placeholder="Current phone">
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                <button type="submit" class="btn btn-primary">edit</button>
              </form>
        
            </div>
          </div>
    </div>
</div>

<script>
const fileInput = document.getElementById('file-input');
const imagePreview = document.getElementById('image-preview');

fileInput.addEventListener('change', function () {
  const file = fileInput.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      imagePreview.src = reader.result;
      imagePreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
  } else {
    imagePreview.style.display = 'none';
  }
});



</script>
@endsection