<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <base href="/public">
    <style type="text/css">
        label{
            display: inline-block;
            width: 200px;
            font-size:15px;
            font-weight: bold;
        }
    </style>
    @include('admin.css')
    
  </head>
  <body>
  <div class="container-scroller">
    
      <!-- partial:partials/_sidebar.html -->
        @include('admin.partial_sidebar')
        <!-- partial:partials/_sidebar.html -->
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')

        <div class="main-panel">
          <div class="content-wrapper">
            <h1 class="text-center display-4">Send email to {{$order->email}}</h1>
            <div class="text-center ">
                <form action="{{url('send_user_email', $order->id)}}" method="POST">

                @csrf

                <div class="mb-3 pl-9 pt-7">
                    <label for="" class="">Email Greeting: </label>
                    <input class="text-dark" type="text" name="greeting">
                </div>

                <div class="mb-3 pl-9 pt-7">
                    <label for="" class="">Email FirstLine: </label>
                    <input class="text-dark" type="text" name="firstline">
                </div>

                <div class="mb-3 pl-9 pt-7">
                    <label for="" class="">Email Body: </label>
                    <input class="text-dark" type="text" name="body">
                </div>

                <div class="mb-3 pl-9 pt-7">
                    <label for="" class="">Email Button Name: </label>
                    <input class="text-dark" type="text" name="button">
                </div>

                <div class="mb-3 pl-9 pt-7">
                    <label for="" class="">Email Url: </label>
                    <input class="text-dark" type="text" name="url">
                </div>

                <div class="mb-3 pl-9 pt-7">
                    <label for="" class="">Email lastline: </label>
                    <input class="text-dark" type="text" name="lastline">
                </div>

                <div class="mb-3">
                   <input type="submit" value="send email" class="btn btn-primary">
                </div>

                </form>
            </div>
          
</div>
</div>
</div>
        <!-- partial -->

    <!-- container-scroller -->
    <!-- plugins:js -->
        @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>