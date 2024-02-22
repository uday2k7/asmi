@extends('layouts.superadminbodytable')

@section('content')
     <div class="card mb-4">
 
    <div class="card-body">

        <form id="create_campaign" action="{{url('cpanel/events/store')}}" method="post" enctype="multipart/form-data" >
               <div class="offset-md-4 col-md-4 pt-5 pb-5" >
                    {{csrf_field()}}
                    @if ($errors->any())
                      @foreach ($errors->all() as $error)
                        <div class="form-group alert alert-danger" role="alert">{{ $error }}</div>
                      @endforeach 
                    @endif
                    
                    <div class="form-group">
                        <label for="event_name">Name <span class="required">(*)</span></label>
                        <input type="text" id="event_name"  name="event_name" class="form-control form-control-user" placeholder="Event Name">
                    </div>
                    <div class="form-group">
                        <label for="icon_name">Upload Icon <span class="required">(*)</span></label>
                        <input type="file" id="icon_name"  name="icon_name" class="form-control form-control-user" >
                    </div>
                   
                   
                  
                </div>
                
                
                <div class="row">
                    <div class="offset-md-4 col-md-4">
                        <input class="btn btn-primary btn-user btn-block" type="submit" value="Save"  />
                    </div>
                </div>
        </form>
    </div>
</div>


@endsection
@section('style')

@endsection
@section('script')
 
@endsection