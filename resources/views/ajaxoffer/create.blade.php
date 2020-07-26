@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{ __('messages.name_form') }}
            </div>

             <div class="alert alert-success" role="alert" id="success_msg" style="display: none;">
                تم الاضافة بنجاح
            </div>



            <form method="POST"  id="offerForm" action="" enctype="multipart/form-data">
                @csrf
              {{--   <input name="_token" value="{{ csrf_token() }}"> --}}
                <div class="form-group">
                  <label for="exampleInputEmail1">Offer Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Offer Name">
                  <small id="name_error" class="form-text text-danger"></small>

                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Offer Price</label>
                  <input type="text" class="form-control" name="price" placeholder="Enter Price">
                  <small id="price_error" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Offer Details</label>
                    <input type="text" class="form-control" name="details" placeholder="enter Details">
                    <small id="details_error" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Photo</label>
                    <input type="file" class="form-control" name="photo">
                    @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <button id="save_offerajax" class="btn btn-primary">Save Offer</button>
              </form>

        </div>
    </div>
</div>
@stop

@section('scripts')
    <script>


        $(document).on('click','#save_offerajax',function(e){
            e.preventDefault();

            $("#name_error").text('');
            $("#price_error").text('');
            $("#details_error").text('');
            var formData=new FormData($('#offerForm')[0]);
            $.ajax({
            type:'post',
            url:"{{ route('store_ajax') }}",
            enctype:'multipart/form-data',
            data:formData,
            processData:false,
            contentType:false,
            cache:false,
            success: function(data){
                if(data.status==true){
                    $('#success_msg').show();
                }else{
                    alert(data.msg);
                }
            },error: function(reject){
                var response=$.parseJSON(reject.responseText);
                $.each(response.errors,function (key,val) {
                   $("#"+key+"_error").text(val[0]);
                });
            }
            });
        });
    </script>
@stop
