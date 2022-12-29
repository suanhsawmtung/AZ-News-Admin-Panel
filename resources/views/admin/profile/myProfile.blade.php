@extends('admin.layouts.app')

@section('content')
  <div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">My Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{ route('profile#updateMyData') }}" method="POST">
                @csrf

                @if (session("updateStatus"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session("updateStatus")}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif  

                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error("userName") is-invalid @enderror" name="userName" id="inputName" value="{{ old('userName',$item->name) }} " placeholder="Name">
                    @error("userName")
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control @error("userEmail") is-invalid @enderror" name="userEmail" id="inputEmail" value="{{ old('userEmail',$item->email) }}"  placeholder="Email">
                    @error("userEmail")
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="userPhone" id="inputPhone" value="{{ $item->phone }}"  placeholder="Phone">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="userGender" id="inputGender">
                            <option value="male" @if ($item->gender == "male") selected @endif>Male</option>
                            <option value="female" @if ($item->gender == "female") selected @endif>Female</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="userAddress" id="inputAddress" cols="30" rows="10" placeholder="Address">{{ $item->address }}</textarea>
                    </div>
                  </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>
              </form>

              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <a href="{{ route('profile#passwordChangePage') }}">Change Password</a>
                </div>
              </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
