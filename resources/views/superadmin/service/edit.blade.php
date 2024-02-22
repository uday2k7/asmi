@extends('layouts.superadminbodytable')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3" id="create_campaign" action="{{url('cpanel/content/update')}}" method="post" enctype="multipart/form-data" >
                <input type="hidden" id="id"  name="id" value="{!! $data['id'] !!}">
                {{csrf_field()}}
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="form-group alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach 
                @endif
                <div class="col-md-6">
                    <label for="heading" class="form-label">Heading <i class="required">(*)</i></label>
                    <input type="text" id="heading"  name="heading" class="form-control" placeholder="Heading Text" value="{!! $data['heading'] !!}" >
                </div>
                <div class="col-md-6">
                    <label for="blank" class="form-label">&nbsp;</label>
                        &nbsp;
                </div>
                <div class="col-md-6">
                    <label for="content_details" class="form-label">Content</label>
                    <textarea class="form-control form-control-user" id="content_details" name="content_details" placeholder="Description" rows="3">{!! $data['content_details'] !!}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="blank" class="form-label">&nbsp;</label>
                    &nbsp;
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