@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="col-4 offset-8">
        @if (session("editStatus"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session("editStatus")}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session("deleteStatus"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session("deleteStatus")}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
            Add Category
        </h3>

        <h3 class="card-title col-3 offset-4">Total-( {{ $categories->total() }} )</h3>

        <div class="card-tools">
          <form action="{{ route('category#categoryPage') }}" method="GET">
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
              <th>Category_ID</th>
              <th>Category Title</th>
              <th>Description</th>
              <th>Created Date</th>
              <th>updated_at</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr class="text-wrap">
                <td class="col-1">{{ $category->id }}</td>
                <td class="col-2">{{ $category->title }}</td>
                <td class="col-3">{{ \Illuminate\Support\str::words($category->description,15,'...') }}</td>
                <td class="col-2">{{ $category->created_at->format('M d, Y h : i A') }}</td>
                <td class="col-2">{{ $category->updated_at->format('M d, Y h : i A') }}</td>
                <td class="col-2">
                  <a href="{{ route('category#categoryEditPage',$category->id) }}">
                    <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                  </a>
                  <a href="{{ route('category#deleteCategory',$category->id) }}">
                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <span class="mt-2 px-4">{{ $categories->appends(request()->query())->links() }}</span>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="card" style="margin-top: 50px">
        <div class="card-header">
            <h3 class="card-title col-2 offset-5">Create Posts</h3>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <form class="form-horizontal" action="{{ route('category#createCategory') }}" method="POST">
                    @csrf

                    @if (session("createStatus"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session("createStatus")}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="form-group row">
                        <label for="categoryTitle" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control @error("categoryTitle") is-invalid @enderror" name="categoryTitle" id="categoryTitle" value="{{ old('categoryTitle') }} " placeholder="Enter category title...">
                          @error("categoryTitle")
                          <small class="invalid-feedback">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
                        <div class="form-group row">
                          <label for="categoryDescription" class="col-sm-2 col-form-label">Description</label>
                          <div class="col-sm-10">
                            <textarea class="form-control @error("categoryDescription") is-invalid @enderror" name="categoryDescription" id="categoryDescription" cols="015" rows="5" placeholder="Enter category description...">{{ old("categoryDescription") }}</textarea>
                            @error("categoryDescription")
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn bg-dark text-white">Create</button>
                        </div>
                      </div>
                  </form>

                </div>
                </div>
              </div>
        </div>
    </div>
  </div>
@endsection
