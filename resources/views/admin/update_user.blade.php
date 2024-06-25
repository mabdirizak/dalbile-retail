<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update Product</title>
    <!-- plugins:css -->
    
    @include('admin.css')
    <style type="text/css">
        label {
            display: inline-block;
            width: 200px;
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
                <h1 class="display-4 pb-5">Update User</h1>
            
                <form action="{{url('/update_user_confirm', $users->id)}}" method="POST">
                    @csrf
                <div class="pb-3">
                <label for="name">User Name:</label>
                <input class="text-dark rounded-md" type="text" name="name" placeholder="Write user name" required="" value="{{$users->name}}">
                </div>
                <div class="pb-3">
                <label for="email">Email:</label>
                <input class="text-dark rounded-md" type="email" name="email" placeholder="Write email" required="" value="{{$users->email}}">
                </div>


                <div class="pb-3">
                
                    <label for="usertype">Select user type:</label>
                    <select class="text-dark" name="usertype" id="usertype"  value="{{$users->usertype}}">
                        <option value="1">Admin</option>
                        <option value="0">Normal User</option>
                    </select>
    
                </div>



                <div class="pb-3">
                <label for="address">Address:</label>
                <input class="text-dark rounded-md" type="text" name="address" placeholder="Write address" value="{{$users->address}}">
                </div>
                <div class="pb-3">
                <label for="phone">Phone:</label>
                <input class="text-dark rounded-md" type="number" name="phone" placeholder="Write phone" required="" value="{{$users->phone}}">
                </div>

                <div class="pb-3">
                
                    <input type="submit" name="submit" value="Update user" class="btn btn-primary">
                    </div>
               
                </form>
            </div>
</div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
        @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>