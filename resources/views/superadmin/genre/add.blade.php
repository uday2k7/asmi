@extends('layouts.superadminbodytable')

@section('content')
    <div class="row">
        <div class="col-6">
          <div class="card">
            @if ($errors->any())
              @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
              @endforeach 
            @endif

            <form class="form-horizontal" method="post" action="store" enctype="multipart/form-data">
              @csrf @method('POST')
              <div class="card-body">
                <div class="form-group row">
                  <label
                    for="fname"
                    class="col-sm-3 text-end control-label col-form-label"
                    >Genre Name</label
                  >
                  <div class="col-sm-9">
                    <input
                      type="text"
                      class="form-control"
                      id="fname"
                      name="genre_name"
                      placeholder="Genre Name Here"
                    />
                  </div>
                </div>
                
                
                               
              </div>
              <div class="border-top">
                <div class="card-body">
                  <button type="submit" class="btn btn-primary">
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
@endsection
@section('style')

@endsection
@section('script')
  <script>
      $("#zero_config").DataTable();
    </script>
@endsection