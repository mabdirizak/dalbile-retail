<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Category</title>
    <!-- plugins:css -->
    @include('admin.css')
    <style type="text/css">
        .center{
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
        }

    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.partial_sidebar')
        <!-- partial:partials/_sidebar.html -->
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
            @endif
        <div class="text-center pt-5">

            <h1 class="display-3 pb-10">Add Category</h1>
            <form action="{{url('/add_category')}}" method="POST">
                @csrf
                <input class="text-dark" type="text" name="category" placeholder="write category name">
                <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
            </form>
</div>
<table class="table text-white">
    <tr class="bg-info">
        <td>Category Name</td>
        <td>Action</td>
    </tr>
    @foreach($data as $data)
    <tr class=" text-white">
        <td class="display-1">{{$data->category_name}}</td>
        <td>
            <a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{url('delete_category', $data->id)}}">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
</div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
        @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>