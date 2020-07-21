@extends('layouts.app')

@section('content')

<div class="alert alert-success" role="alert" id="success_msg" style="display: none;">
    تم الاضافة بنجاح
</div>

        <table class="table">
            <thead>
             <tr>
                <th scope="col">number_offer</th>
                <th scope="col">Name_Offer</th>
                <th scope="col">Price_Offer</th>
                <th scope="col">Details</th>
                <th scope="col">Operation</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($offers as $offer)
                <tr class="offerrow{{$offer->id}}">
                  <th scope="row">{{$offer->id}}</th>
                  <td>{{$offer->name}}</td>
                  <td>{{$offer->price}}</td>
                  <td>{{$offer->details}}</td>
                  <td>
                      <a href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-success">Update</a>
                      <a href="{{route('offers_delete',$offer->id)}}" class="btn btn-danger">Delete</a>
                      <a href="" offer_id="{{$offer->id}}" class="delete_btn btn btn-danger" >Deleteajax</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
          </table>

@stop

@section('scripts')
    <script>


        $(document).on('click','.delete_btn',function(e){
            e.preventDefault();

           var offerid= $(this).attr('offer_id');
            $.ajax({
            type:'post',
            url:"{{ route('delete_ajax') }}",
            data:{
                 '_token': "{{csrf_token()}}",

                 'id':offerid
            },
            success: function(data){
                if(data.status==true){
                    $('#success_msg').val(data.msg);
                    $('#success_msg').show();

                    $('.offerrow'+data.data_remove).remove();
                }else{
                    $('#success_msg').val(data.msg);
                    $('#success_msg').show();
                }
            },error: function(reject){
            }
            });
        });
    </script>
@stop
