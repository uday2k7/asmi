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
               

              
              <div class="table-responsive">
                <table
                  id="zero_config"
                  class="table table-striped table-bordered"
                >
                  <thead>
                    <tr>
                        
                        <th>Page</th>
                        <th>Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                   
                    <tr>
                        
                        <td>Privacy</td>
                        <td>{!! $data['content'] !!}</td>
                        
                        <td style="width:300px">
                            <a href="{{ url('cpanel/privacy/edit/'.$data['id']) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-pen fa-sm"></i> Edit</a>
                        </td>
                    </tr>
                    
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