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
                    <a class="btn btn-primary" href="{{ url('cpanel/service/items-we-offered/add') }}">Add Item</a>
                </h5> 
 
              
              <div class="table-responsive">
                <table
                  id="zero_config"
                  class="table table-striped table-bordered"
                >
                  <thead>
                    <tr>
                      
                      <th>Image</th>
                      <th>Group Name</th>
                      <th>Create Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $details)
                    <tr>
                      
                      <td><img src="{!! $details['image'] !!}" alt="{!! $details['heading'] !!}" class="img-fluid img-thumbnail" width="120" /></td>
                      <td>{!! $details['heading'] !!}</td>
                      
                      
                      <td data-sort="{!! $details['updated_at'] !!}">{!! \Carbon\Carbon::parse($details['updated_at'])->format('j F, Y')   !!}</td>
                      <td>
                        <a href="{{ url('cpanel/service/items-we-offered/details/'.$details['id']) }}" type="button" class="btn btn-outline-secondary"><i class="fas fa-tv"></i> View</button>
                      </td>
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