<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

        @include('nevbar.navebar')

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


                <form method="POST"  action="{{ route('offers.store') }}">
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

                    <button type="submit" class="btn btn-primary">Save Offer</button>
                  </form>

            </div>
        </div>

    </body>
</html>
