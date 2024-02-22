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
                      <th>ID</th>
                      <th>Images</th>
                      <th>Heading</th>
                      <th>Content</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $details)
                    <tr>
                      <td>{!! $details['id'] !!}</td>
                      <td><img src="{!! $details['image'] !!}" alt="{!! $details['heading'] !!}" class="img-fluid img-thumbnail" width="120" /></td>
                      <td>{!! $details['heading'] !!}</td>
                      <td>{!! $details['content'] !!}</td>
                      <td data-sort="{!! $details['created_at'] !!}">{!! \Carbon\Carbon::parse($details['created_at'])->format('j F, Y')   !!}</td>
                      <td>
                        <a href="{{ url('cpanel/content/edit/'.$details['id']) }}" type="button" class="btn btn-outline-secondary"><i class="fa fa-edit" ></i> Edit</button>
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
    $('#zero_config').DataTable({
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false,
                "sortable": false
            },
            {
                "targets": [ 1 ],
                "visible": true,
                "searchable": true,
                "sortable": true
            },
            {
                "targets": [ 2 ],
                "visible": true,
                "searchable": true,
                "sortable": true
            },
            {
                "targets": [ 3 ],
                "visible": true,
                "searchable": true,
                "sortable": true
            }

        ],
        language: { 
            searchPlaceholder: "Find in table",
        },
        order: [[0, 'desc']],
    });
  </script>
@endsection