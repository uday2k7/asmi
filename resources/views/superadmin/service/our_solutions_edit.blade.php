@extends('layouts.superadminbodytable')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3" id="create_campaign" action="{{url('cpanel/service/our-solutions-edit')}}" method="post" enctype="multipart/form-data" >
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
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control form-control-user" id="content" name="content" placeholder="Description" rows="3">{!! $data['content'] !!}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="blank" class="form-label">&nbsp;</label>
                    &nbsp;
                </div>

                <div class="col-md-6">
                    <label for="content" class="form-label">Image(Upload 416px X 381px Image)</label>
                    <input type="file" accept="image/png, image/jpg, image/jpeg" name="file" class="custom-file-input" id="chooseFile">

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