@extends('admin.layouts.app')

@section('content')
<div class="col-4 offset-8">
    @if (session("deleteStatus"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session("deleteStatus")}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">User Account Lists</h3>

        <div class="card-tools">
          <form action="{{ route('account#accountListPage') }}" method="get">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="key" class="form-control float-right" value="{{ request('key') }}" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>User_ID</th>
              <th>User Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Address</th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           @foreach ($users as $user)
           <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->gender }}</td>
            <td>
              @if ($user->id != Auth::user()->id)
              <a href="{{ route('account#deleteAccount',$user->id) }}">
                <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
              </a>
              @endif
            </td>
          </tr>
           @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
