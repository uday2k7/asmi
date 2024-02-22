@extends('layouts.superadminbodytable')

@section('content')
    <div class="row">
        <div class="col-6">
          <div class="card">
            <form action="{{url('cpanel/privacy/update')}}" method="post" enctype="multipart/form-data">

              <input type="hidden" name="con_id" id="con_id" value="{!! $data->id !!}" /> 
              {{csrf_field()}}
              @if ($errors->any())
                @foreach ($errors->all() as $error)
                  <div class="form-group alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach 
              @endif
              <div class="col-sm-9">
                <textarea class="form-control form-control-user" id="campaign_description" name="campaign_description" placeholder="Privacy Policy" rows="3">{!! $data->content !!}</textarea>
              </div>
              <div class="row">
                <div class="offset-md-4 col-md-4">
                  <input class="btn btn-primary btn-user btn-block" type="submit" value="Update"  />
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
@endsection
@section('style')
<link rel="stylesheet" href="{{ url('influencer/css/croppie.css') }}">
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/super-build/ckeditor.js"></script>    
    <script type="text/javascript" src="{{ url('influencer/js/editor.js') }}"></script>

    
    <script src="{{ url('influencer/js/croppie.js') }}"></script>
    <script type="text/javascript" src="{{ url('influencer/js/upload.js') }}"></script>
  
@endsection