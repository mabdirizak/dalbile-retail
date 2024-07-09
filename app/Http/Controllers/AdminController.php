<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Models\Product;

use App\Models\Category;
use App\Models\User;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB; 

class AdminController extends Controller
{
    public function view_category()
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
              
        $data = category::all();
        return view('admin.category', compact('data'));
        }
        else
        {
            return redirect('login');
        }
      
    }

    public function add_category(Request $request)
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
        $data = new Category;

        $data->category_name=$request->category;

        $data->save();

        return redirect()->back()->with('message','Category added successfully');
        }

        else
        {
            return redirect('login');
        }
        

    }

    public function delete_category($id)
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
        
        $data = category::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Category deleted successfully');
        }

        else 
        {
            return redirect('login');
        }
    }

    public function view_product()
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $category=Category::all();
            return view('admin.product', compact('category'));
        }

        else
        {
            return redirect('login');
        }
       
    }

    public function add_product(Request $request)
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $product = new Product;

        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount;
        $product->category=$request->category;
        
        //image save to db
        $image=$request->image;
        $image=request()->validate([
            'image' => 'image',
        ]);

        $image = $request->file('image');

        $imagename = time().'.'.$image->getClientOriginalExtension();

        $image->move('product', $imagename);
        $product->image=$imagename;


        $product->save();

        return redirect()->back()->with('message', 'Product added successfully');
        }

        else 
        {
            return redirect('login');
        }
        
        
    }

    public function show_product()
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            
        $product=Product::all();
        return view('admin.show_product', compact('product'));
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function delete_product($id)
    {

        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $data=Product::find($id);
            $data->delete();
            return redirect()->back()->with('message', 'Product deleted successfully');
        }
        else
        {
            return redirect('login');
        }
       
    }

    public function update_product($id)
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $product=Product::find($id);

        $category=Category::all();

        return view('admin.update_product', compact('product', 'category'));
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function update_product_confirm(Request $request, $id)
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $product=Product::find($id);

        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->discount_price=$request->discount;
        $product->quantity=$request->quantity;
        $product->category=$request->category;

        //image
        $image=$request->image;

        if($image)
        {
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image=$imagename;
        }
        

        $product->save();

        return redirect()->back()->with('message', 'Product updated successfully');
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function order()

    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $order=Order::all();
            return view('admin.order', compact('order'));
        }
        else
        {
            return redirect('login');
        }
     
    }

    public function delivered($id)

    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $order=Order::find($id);

       $order->delivery_status = "Delivered";
       $order->payment_status = "Paid";

       $order->save();

       return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
       
    }

    public function print_pdf($id)

    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $order=Order::find($id);
    //   $pdf=PDF::loadView('admin.pdf', $order);
    //   return $pdf->download('order_details.pdf');
          // Pass the order to the view as part of an array
          if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

          $pdf = PDF::loadView('admin.pdf', compact('order')); 
          return $pdf->download('order_details.pdf');
        }
        else
        {
            return redirect('login');
        }
      
    }

    public function send_email($id)

    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $order=Order::find($id);
       return view('admin.email_info', compact('order'));
        }
        else
        {
            return redirect('login');
        }
       
    }

    public function send_user_email(Request $request , $id)

    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $order=Order::find($id);

        $details = [
            'header' =>$request->header,
           
            'body' =>$request->body
        ];

        Notification::send($order, new SendEmailNotification($details));

        return redirect()->back()->with('message', 'Email was sent successfully');
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function searchdata(Request $request)

    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $searchText = $request->search;
      $order=Order::where('name', 'LIKE', "%$searchText%")->orWhere('phone', 'LIKE', "%$searchText%")->orWhere('product_title', 'LIKE', "%$searchText%")->get();

      return view('admin.order', compact('order'));
        }
        else
        {
            return redirect('login');
        }
       
    }
    // user section
    public function view_user()
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
              
        $users = User::all();
        
        
        return view('admin.user', compact('users'));

        }
        else
        {
            return redirect('login');
        }
      
    }

    public function add_user(Request $request)
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
        $users = new User;

        $users->name=$request->name;
        $users->email=$request->email;
        $users->usertype=$request->usertype;
        $users->address=$request->address;
        $users->phone=$request->phone;
        $users->password=$request->password;

        $users->save();

        return redirect()->back()->with('message','User added successfully');
        }

        else
        {
            return redirect('login');
        }
        

    }

    public function delete_user($id)
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
        
        $users = User::find($id);

        $users->delete();

        return redirect()->back()->with('message', 'User deleted successfully');
        }

        else 
        {
            return redirect('login');
        }
    }

    public function update_user($id)
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
        $users=User::find($id);

        return view('admin.update_user', compact('users'));
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function update_user_confirm(Request $request, $id)
    {
        if(Auth::id() && Auth::User()->usertype == 1)
        {
            $users=User::find($id);

            $users->name=$request->name;
            $users->email=$request->email;
            $users->usertype=$request->usertype;
            $users->address=$request->address;
            $users->phone=$request->phone;
            
    
        $users->save();


        return redirect()->back()->with('message', 'User updated successfully');
        }
        else
        {
            return redirect('login');
        }

        
        
    }

    public function dailyReport()
    {
        $dailyOrders = DB::table('orders')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(CAST(price AS DECIMAL(10, 2)) * CAST(quantity AS UNSIGNED)) as total_sales'))
        ->groupBy(DB::raw('DATE(created_at)', ))
        ->get();
        
        return view('admin.daily', compact('dailyOrders'));
    }

    public function monthlyReport()
    {
        $monthlyOrders = DB::table('orders')
    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(CAST(price AS DECIMAL(10, 2)) * CAST(quantity AS UNSIGNED)) as total_sales'))
    ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
    ->get();
        
        return view('admin.monthly', compact('monthlyOrders'));
    }
}

