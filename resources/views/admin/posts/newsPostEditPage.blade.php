@extends('admin.layouts.app')

@section('content')
  <div class="col-12  mt-5">
    <div class="col-md-8 offset-2">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Category Create Page</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal row" action="{{ route('news#newsPostEdit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="col-9">
                  <div class="form-group row">
                    <label for="newsTitle" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control  @error('newsTitle') is-invalid @enderror" name="newsTitle"  id="newsTitle"  placeholder="Enter news title..."  value="{{ old('newsTitle',$post->title) }}"/>
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
                              <option value="{{ $category->id }}" @if ($category->id=$post->category_id) selected @endif>{{ $category->title }}</option>
                              @endforeach
                          </select>
                        @error("newsCategory")
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="newsDescription" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                        <textarea class="form-control @error('newsDescription') is-invalid @enderror" name="newsDescription" id="newsDescription" cols="30" rows="10" placeholder="Enter category description...">{{ old("newsDescription",$post->description) }}</textarea>
                        @error("newsDescription")
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>
                </div>
                <div class="col-3">
                  <div class="form-group row">
                    <div class="col-sm-12 ">
                      <img src="{{ asset('storage/'.$post->image) }}" class="img-thumbnail w-100">
                      <input type="hidden" name="id" value="{{ $post->id }}">
                      <input type="file" class="form-control w-100 @error('newsImage') is-invalid @enderror" name="newsImage" id="newsImage"  >
                      @error("newsImage")
                      <small class="invalid-feedback">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <button type="submit" class="btn bg-dark text-white w-100">Create</button>
                    </div>
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
