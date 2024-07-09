<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daily report</title>
    <!-- plugins:css -->
    @include('admin.css')
    <style type="text/css">
        .center{
            margin: auto;
            width: 50%;
            height: 80%;
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
      

       
        <div class="container">
            <h1>Daily Sales Report</h1>
            <table class="table" style="margin-top: 20px;">
                <thead>
                    <tr style="background-color: #f8f9fa; color: #343a40; font-weight: bold;">
                        <th>Date</th>
                        <th>Total Revenue</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailyOrders as $order)
                    <tr>
                        <td>{{ $order->date }}</td>
                        <td>{{ $order->total_sales }}</td>

                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      
        
</div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
        @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>