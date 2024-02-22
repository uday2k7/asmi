@extends('layouts.superadminbodytable')

@section('content')
	<div class="card mb-4">
		<div class="card-body">
			<form class="row g-3" id="create_campaign" action="{{url('cpanel/banner/inner/update')}}" method="post" enctype="multipart/form-data" >
				<input type="hidden" id="id"  name="id" value="{!! $data['id'] !!}">
				{{csrf_field()}}
				@if ($errors->any())
					@foreach ($errors->all() as $error)
						<div class="form-group alert alert-danger" role="alert">{{ $error }}</div>
					@endforeach 
				@endif
				<div class="col-md-6">
					<label for="heading_text" class="form-label">Name <i class="required">(*)</i></label>
					<input type="text" id="heading_text"  name="heading_text" class="form-control" placeholder="Heading Text" value="{!! $data['heading_text'] !!}" >
				</div>
				<div class="col-md-6">
					<label for="blank" class="form-label">&nbsp;</label>
						&nbsp;
				</div>
				<div class="col-md-6">
					<label for="description" class="form-label">Description</label>
					<textarea class="form-control form-control-user" id="description" name="description" placeholder="Description" rows="3">{!! $data['description'] !!}</textarea>
				</div>
				<div class="col-md-6">
					<label for="blank" class="form-label">&nbsp;</label>
					&nbsp;
				</div>
				<div class="col-md-6">
					<label for="inputEmail4" class="form-label">Image(Image will resized to 1600px*900px) <i class="required">(*)</i></label>
					<input type="file" id="icon_name"  name="icon_name" class="form-control form-control-user" >
				</div>
				<div class="col-md-6">
					<label for="inputPassword4" class="form-label">&nbsp</label>
					<img src="{!! $data['image'] !!}" alt="{!! $data['heading_text'] !!}" class="img-thumbnail" width="200" />
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