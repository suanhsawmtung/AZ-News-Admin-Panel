@extends('admin.layouts.app')

@section('content')
  <div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Category Edit Page</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{ route('category#editCategory',$item->id) }}" method="POST">
                @csrf

                <div class="form-group row">
                  <label for="categoryTitle" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error("categoryTitle") is-invalid @enderror" name="categoryTitle" id="categoryTitle" value="{{ old('categoryTitle',$item->title) }} " placeholder="Enter category title...">
                    @error("categoryTitle")
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                  <div class="form-group row">
                    <label for="categoryDescription" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control @error("categoryDescription") is-invalid @enderror" name="categoryDescription" id="categoryDescription" cols="30" rows="10" placeholder="Enter category description...">{{ old("categoryDescription",$item->description) }}</textarea>
                      @error("categoryDescription")
                      <small class="invalid-feedback">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
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
