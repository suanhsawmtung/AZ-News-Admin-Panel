@extends('admin.layouts.app')

@section('content')
  <div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{ route('profile#changePassword') }}" method="POST">
                @csrf

                <div class="form-group row">
                  <label for="oldPassword" class="col-sm-3 col-form-label">Old Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control @error("oldPassword") is-invalid @enderror @if (session('oldPasswordError')) is-invalid @endif" name="oldPassword" id="oldPassword" value="{{ old('oldPassword') }}" placeholder="Enter old password..">
                    @error("oldPassword")
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                    @if (session("oldPasswordError"))
                    <small class="invalid-feedback">{{ session('oldPasswordError') }}</small>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                    <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control @error("newPassword") is-invalid @enderror" name="newPassword" id="newPassword" value="{{ old('newPassword') }}" placeholder="Enter new passwword..">
                      @error("newPassword")
                      <small class="invalid-feedback">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control @error("confirmPassword") is-invalid @enderror" name="confirmPassword" id="confirmPassword" value="{{ old('confirmPassword') }}" placeholder="Enter confirm passwword..">
                      @error("confirmPassword")
                      <small class="invalid-feedback">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                <div class="form-group row">
                  <div class="offset-sm-3 col-sm-9">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>
              </form>

              {{-- <div class="form-group row">
                <div class="offset-sm-3 col-sm-9">
                  <a href="">Change Password</a>
                </div>
              </div> --}}

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
