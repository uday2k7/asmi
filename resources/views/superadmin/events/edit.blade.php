@extends('layouts.superadminbodytable')

@section('content')
<div class="card mb-4">
<div class="card-body">
<form class="row g-3" id="create_campaign" action="{{url('cpanel/events/update')}}" method="post" enctype="multipart/form-data" >
<input type="hidden" id="event_id"  name="event_id" value="{!! $data->id !!}">
                <input type="hidden" id="old_image"  name="old_image"  value="{!! $data->icon_path !!}">
                {{csrf_field()}}
                @if ($errors->any())
                      @foreach ($errors->all() as $error)
                        <div class="form-group alert alert-danger" role="alert">{{ $error }}</div>
                      @endforeach 
                    @endif
<div class="col-md-6">
<label for="event_name" class="form-label">Name <i class="required">(*)</i></label>
<input type="text" id="event_name"  name="event_name" class="form-control" placeholder="Emotion Name" value="{!! $data->name !!}" >
</div>
<div class="col-md-6">
<label for="blank" class="form-label">&nbsp;</label>
&nbsp;
</div>

<div class="col-md-6">
<label for="inputEmail4" class="form-label">Upload Icon <i class="required">(*)</i></label>
<input type="file" id="icon_name"  name="icon_name" class="form-control form-control-user" >
</div>
<div class="col-md-6">
<label for="inputPassword4" class="form-label">&nbsp</label>
<img src="{!! $data->icon_path !!}" alt="{!! $data->name !!}" class="img-thumbnail" width="80" />
</div>

<div class="col-12">
<input class="btn btn-primary btn-user btn-block" type="submit" value="Update"  />
</div>
</form>
</div>
</div>
@endsection
@section('style')

@endsection
@section('script')
 
@endsection