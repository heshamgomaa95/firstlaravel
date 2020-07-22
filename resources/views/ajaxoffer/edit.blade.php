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



            <form method="POST"  id="offerForm_edit" action="" enctype="multipart/form-data">
                @csrf
              {{--   <input name="_token" value="{{ csrf_token() }}"> --}}
                <div class="form-group">
                  <label for="exampleInputEmail1">Offer Name</label>
                  <input type="text" class="form-control" name="offer_id" value="{{ $offer->id}}" style="display: none" placeholder="Enter Offer Name">
                  <input type="text" class="form-control" name="name" value="{{ $offer->name }}"placeholder="Enter Offer Name">
                  @error('name')
                  <small class="form-text text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Offer Price</label>
                  <input type="text" class="form-control" name="price" value="{{ $offer->price }}" placeholder="Enter Price">
                  @error('price')
                  <small class="form-text text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Offer Details</label>
                    <input type="text" class="form-control" name="details" value="{{ $offer->details }}"placeholder="enter Details">
                    @error('details')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Photo</label>
                    <input type="file" class="form-control" name="photo">
                    @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <button id="update_offerajax" class="btn btn-primary">Save Offer</button>
              </form>

        </div>
    </div>
</div>
@stop

@section('scripts')
    <script>


        $(document).on('click','#update_offerajax',function(e){
            e.preventDefault();

            var formData=new FormData($('#offerForm_edit')[0]);
            $.ajax({
            type:'post',
            url:"{{ route('update_ajax') }}",
            enctype:'multipart/form-data',
            data:formData,
            processData:false,
            contentType:false,
            cache:false,
            success: function(data){
                if(data.status==true){
                    $('#success_msg').show();
                    $('#success_msg').text(data.msg);
                }else{
                    $('#success_msg').show();
                    $('#success_msg').text(data.msg);                }
            },error: function(reject){
            }
            });
        });
    </script>
@stop
