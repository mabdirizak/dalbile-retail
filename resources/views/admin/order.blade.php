<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    @include('admin.css')
    <style>
    .small-table {
        width: 80%; /* Adjust the width as needed */
        /* You can also adjust other properties like font size, padding, etc. */
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
            <h1 class="display-3 text-center pb-3 ">All Orders</h1>

            <div class="text-center pb-6 m-auto">
              <form action="{{url('search')}}" method="get">
                @csrf
                <input type="text" name="search" placeholder="Search for something" class="text-dark">
                <input type="submit" value="Search" class="btn btn-outline-primary">
              </form>
            </div>

            <table class="table small-table m-auto pb-3 ">
                <tr class="text-info m-auto">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Delivered</th>
                    <th>Print as PDF</th>
                    <th>Send email</th>
                </tr>

                @forelse($order as $order)

                <tr class="text-white">
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>
                        <img src="/product/{{$order->image}}" alt="product image">
                    </td>

                    <td>

                       @if($order->delivery_status=='Processing')
                        <a href="{{url('delivered', $order->id)}}" onclick="return confirm('Are you sure this product is delivered? !!!')" class="btn btn-success">Delivered</a>
                        @else
                        <p class="text-success">Delivered</p>
                        @endif
                    </td>

                    <td>
                        <a href="{{url('print_pdf', $order->id)}}" class="btn btn-secondary">PDF</a>
                    </td>
                    
                    <td>
                      <a href="{{url('send_email', $order->id)}}" class="btn btn-primary">Send email</a>
                    </td>
                </tr>

                @empty
                 <tr class="text-center display-3">
                  <td colspan="16">
                    <h1 class="text-warning">No data was found.</h1>
                  </td>
                 </tr>

                @endforelse
            </table>
</div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
        @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>