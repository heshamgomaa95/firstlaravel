@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{ __('messages.name_form') }}
            </div>

            @if (Session::has('success'))
             <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
             </div>
             <br>
            @endif


            <form method="POST"  action="{{ route('offers_store') }}" enctype="multipart/form-data">
                @csrf
              {{--   <input name="_token" value="{{ csrf_token() }}"> --}}
                <div class="form-group">
                  <label for="exampleInputEmail1">Offer Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Offer Name">
                  @error('name')
                  <small class="form-text text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Offer Price</label>
                  <input type="text" class="form-control" name="price" placeholder="Enter Price">
                  @error('price')
                  <small class="form-text text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Offer Details</label>
                    <input type="text" class="form-control" name="details" placeholder="enter Details">
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

                <button type="submit" class="btn btn-primary">Save Offer</button>
              </form>

        </div>
    </div>
</div>
@stop

@section('scripts')
    <script>

    </script>
@stop
