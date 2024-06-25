<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Product</title>
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
                <h1 class="display-4 pb-5">Add Product</h1>
            
                <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="pb-3">
                <label for="product">Product Title:</label>
                <input class="text-dark rounded-md" type="text" name="title" placeholder="Write product name" required="">
                </div>
                <div class="pb-3">
                <label for="description">Product Description:</label>
                <input class="text-dark rounded-md" type="text" name="description" placeholder="Write product description" required="">
                </div>
                <div class="pb-3">
                <label for="price">Product Price:</label>
                <input class="text-dark rounded-md" type="number" name="price" placeholder="Write product price" required="">
                </div>
                <div class="pb-3">
                <label for="discount">Discounted Price:</label>
                <input class="text-dark rounded-md" type="number" name="discount" min="0" placeholder="Write discounted price">
                </div>
                <div class="pb-3">
                <label for="quantity">Product Quantity:</label>
                <input class="text-dark rounded-md" type="number" name="quantity" min="0" placeholder="Write product quantity" required="">
                </div>
                <div class="pb-3">
                <label for="category">Product Category:</label>
                <select class="text-dark" name="category" id="category" required="">
                    <option value="" selected>Please select category</option>
                    @foreach($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="pb-3">
                <label for="Quantity">Product Image:</label>
                <input type="file" name="image" required="">
                </div>
                <div class="pb-3">
                
                <input type="submit" name="submit" value="Add product" class="btn btn-primary">
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