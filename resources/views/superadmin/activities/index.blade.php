@extends('layouts.superadminbodytable')

@section('content')
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                @if (\Session::has('error'))
                    <div class="alert alert-warning">
                        {!! \Session::get('error') !!}
                    </div>
                @endif
                @if (\Session::has('message'))
                    <div class="alert alert-info">
                        {!! \Session::get('message') !!}
                    </div>
                @endif
                <h5 class="card-title">
                    <a class="btn btn-primary" href="{{ url('cpanel/activities/add') }}">Add Activity</a>
                </h5> 

              
              <div class="table-responsive">
                <table
                  id="zero_config"
                  class="table table-striped table-bordered"
                >
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Icon</th>
                      <th>Status</th>
                      <th>Create Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $details)
                    <tr>
                      <td>{!! $details['name'] !!}</td>
                      <td><img src="{!! $details['icon_path'] !!}" alt="{!! $details['name'] !!}" class="img-thumbnail" width="80" /></td>
                      <td>
                        @if($details['display']==1)
                          <button type="button" class="btn btn-success btn-sm text-white">
                            Active
                          </button>
                        @else
                          <button type="button" class="btn btn-danger btn-sm text-white">
                            Inactive
                          </button>
                        @endif
                        
                  
                      </td>
                      <td data-sort="{!! $details['created_at'] !!}">{!! \Carbon\Carbon::parse($details['created_at'])->format('j F, Y')   !!}</td>
                    </tr>
                    @endforeach
                    
                    
                  </tbody>
                  
                </table>
              </div>
            </div>
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