@extends('layouts.superadminbodytable')

@section('content')
     <div class="card mb-4">
 
    <div class="card-body">

        <form id="create_campaign" action="{{url('cpanel/service/items-we-offered/details/store')}}" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="item_id" value="{{ $id }}">
               <div class="offset-md-4 col-md-4 pt-5 pb-5" >
                    {{csrf_field()}}
                    @if ($errors->any())
                      @foreach ($errors->all() as $error)
                        <div class="form-group alert alert-danger" role="alert">{{ $error }}</div>
                      @endforeach 
                    @endif
                    
                    <div class="col-md-12">
                        <label for="content" class="form-label">Image(Upload 416px X 416px Image)</label>
                        <input type="file" accept="image/png, image/jpg, image/jpeg" name="file" class="custom-file-input" id="chooseFile">

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