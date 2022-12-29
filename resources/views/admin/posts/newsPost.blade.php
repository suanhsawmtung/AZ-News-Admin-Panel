@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="col-4 offset-8">
        @if (session("createStatus"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session("createStatus")}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session("deleteStatus"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session("deleteStatus")}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session("updateStatus"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session("updateStatus")}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
            <a href="{{ route('news#newsCreatePage') }}">
                <button class="btn btn-sm btn-outline-dark">Add News</button>
            </a>
        </h3>
        <h3 class="card-title col-2 offset-5">Total - ( {{ $items->total() }} )</h3>
        <div class="card-tools">
            <form action="{{ route('news#newsListPage') }}" method="GET">
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
              <th>Image</th>
              <th>Post Title</th>
              <th>Category_ID</th>
              <th>Description</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)
            <tr class='text-wrap' >
                <td class="col-2"><img src="{{ asset('storage/'.$item->image) }}" style="width:90px;height:100px;background-position:cover;"></td>
                <td class="col-1">{{ $item->title }}</td>
                <td class="col-1">{{ $item->category_id }}</td>
                <td class="col-3 ">{{ \Illuminate\Support\str::words($item->description,20,'...') }}</td>
                <td class="col-2">{{ $item->created_at->format('M d, Y h : i A') }}</td>
                <td class="col-2">{{ $item->updated_at->format('M d, Y h : i A') }}</td>
                <td class="col-1">
                  <a href="{{ route('news#newsPostEditPage',$item->id) }}">
                    <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                  </a>
                  <a href="{{ route('news#deleteNewsPost',$item->id) }}">
                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    {{ $items->appends(request()->query())->links() }}
  </div>
@endsection
