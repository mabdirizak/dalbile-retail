<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Users</title>
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

            <h1 class="display-3 pb-10">Add User</h1>
            <form action="{{url('/add_user')}}" method="POST">
                @csrf
                <input class="text-dark" type="text" name="name" placeholder="write name">
                <input class="text-dark" type="text" name="email" placeholder="write email">

                <label for="usertype">Select user type:</label>
                <select class="text-dark" name="usertype" id="usertype">
                    <option value="1">Admin</option>
                    <option value="0">Normal User</option>
                </select>


                <input class="text-dark" type="text" name="address" placeholder="write address">
                <input class="text-dark" type="number" name="phone" placeholder="write phone">
                <input class="text-dark" type="password" name="password" placeholder="write password">
                <input type="submit" class="btn btn-primary" name="submit" value="Add user">
            </form>
</div>

<table class="table text-white">
    <tr class="bg-info">
        <td>User Name</td>
        <td>Email</td>
        <td>UserType</td>
        <td>Address</td>
        <td>Phone</td>
        <td>Edit</td>
        <td>Delete</td>

    </tr>
    @foreach($users as $user)
    <tr class=" text-white">
        <td class="display-1">{{$user->name}}</td>
        <td class="display-1">{{$user->email}}</td>
        <td class="display-1">{{$user->usertype}}</td>
        <td class="display-1">{{$user->address}}</td>
        <td class="display-1">{{$user->phone}}</td>

        <td>
            <a class="btn btn-success" href="{{url('update_user', $user->id)}}">Edit</a>
        </td>
        <td>
            <a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{url('delete_user', $user->id)}}">Delete</a>
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