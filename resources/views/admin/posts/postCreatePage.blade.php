@extends('admin.layouts.app')

@section('content')
  <div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Category Create Page</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{ route('news#newsPostCreate') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (session("createStatus"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session("createStatus")}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="form-group row">
                  <label for="newsTitle" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control  @error('newsTitle') is-invalid @enderror" name="newsTitle"  id="newsTitle" value="{{ old('newsTitle') }}"  placeholder="Enter news title..."/>
                    @error("newsTitle")
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="newsCategory" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select name="newsCategory" id="newsCategory" class="form-control @error('newsCategory') is-invalid @enderror">
                            <option value="">Choose category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                      @error("newsCategory")
                      <small class="invalid-feedback">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="newsImage" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control @error('newsImage') is-invalid @enderror" name="newsImage" id="newsImage" value="{{ old('newsImage') }} " >
                      @error("newsImage")
                      <small class="invalid-feedback">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="newsDescription" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control @error('newsDescription') is-invalid @enderror" name="newsDescription" id="newsDescription" cols="30" rows="10" placeholder="Enter category description...">{{ old("newsDescription") }}</textarea>
                      @error("newsDescription")
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
  </div>
@endsection
