<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $product=Product::paginate(10);
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        return view('home.userpage',compact('product', 'comment', 'reply'));

    }


    public function redirect()
    {
            // User is authenticated, proceed with retrieving user type
            $usertype = Auth::user()->usertype;
            if($usertype == '1') 
            {
                $total_products=Product::all()->count();
                $total_orders=Order::all()->count();
                $total_customers=User::all()->count();
                
                $order=Order::all();
                $total_revenue = 0;
                

                foreach($order as $order)
                {
                  $total_revenue = $total_revenue + $order->price;
                }

                $orders_delivered = Order::where('delivery_status', '=', 'delivered')->get()->count();
                $orders_processing = Order::where('delivery_status', '=', 'Processing')->get()->count();

                return view('admin.home', compact('total_products', 'total_orders', 'total_customers', 'total_revenue', 'orders_delivered', 'orders_processing'));
            } 
            else 
            {   
                $product=Product::paginate(10);

                $comment = Comment::orderby('id', 'desc')->get();
                $reply = Reply::all();
                //dd($comment);

            return view('home.userpage', compact('product', 'comment', 'reply'));
            }
}

    public function product_details($id)
    {
            $product=Product::find($id);        
            return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {
            //cool 2 line code to know logged in user!
            $user=Auth::user();
            $userid=$user->id;
            //dd($user);
            $product=Product::find($id);
            //dd($product);

            $product_exist_id = Cart::where('Product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();

            if($product_exist_id != null)
            {
                $cart=Cart::find($product_exist_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $request->quantity;

                if($product->discount_price !=null)
            {
                $cart->price=$product->discount_price * $cart->quantity;
            }
            else
            {
                $cart->price=$product->price * $cart->quantity;
            }

                $cart->save();

                Alert::success('Product added successfully', 'we have added product to the cart');

                return redirect()->back();
            }
            else
            {
                $cart=new cart;
            
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;

            //from product table

            
            $cart->product_title=$product->title;

            if($product->discount_price !=null)
            {
                $cart->price=$product->discount_price * $request->quantity;
            }
            else
            {
                $cart->price=$product->price * $request->quantity;
            }
            
            //image
            $cart->image=$product->image;
            //quantity
            $cart->quantity=$request->quantity;
            $cart->Product_id=$product->id;

            $cart->save();

            return redirect()->back()->with('message', 'Product added successfully to your cart!');
            }
            //from user table
            

        }
        else
        {
            return redirect('login');
        }
    }

    public function show_cart()

    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $cart=cart::where('user_id', '=', $id)->get();
            return view('home.showcart', compact('cart'));
        }
        else 
        {
            return redirect('login');
        }
    }

    public function remove_cart($id)

    {
        $cart=cart::find($id);

        $cart->delete();

        return redirect()->back()->with('message', 'Cart deleted successfully');
    }

    public function cash_order()
    {
        $user=Auth::user();
        $userid=$user->id;
        
        $data=Cart::where('user_id', '=', $userid)->get();

        foreach($data as $data)
        {
            







            $order= new Order;
            //1. $order->(name) coming from orders table      2. $data->(name) coming from cart table. 
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;


            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->Product_id;


            $order->payment_status='Cash on Delivery';
            $order->delivery_status='Processing';

            $order->save();

            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();

        }

        return redirect()->back()->with('message', 'We have received your order. We will connect you soon...');
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }


    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "thanks for the payment." 
        ]);

        $user=Auth::user();
        $userid=$user->id;
        
        $data=Cart::where('user_id', '=', $userid)->get();

        foreach($data as $data)
        {
            $order= new Order;
            //1. $order->(name) coming from orders table      2. $data->(name) coming from cart table. 
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;


            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->Product_id;


            $order->payment_status='Paid';
            $order->delivery_status='Processing';

            $order->save();

            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();

        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    public function show_order()

    {
        
        if(Auth::id())
        {
            $user=Auth::user();
            $userid = $user->id;
            $order=Order::where('user_id', '=', $userid)->get();
            return view('home.showorder', compact('order'));
        }
        else 
        {
            return redirect('login');
        }
    }

    public function cancel_order($id)

    {
        $order=Order::find($id);
        $order->delivery_status="You canceled the order";
        $order->save();

        return redirect()->back();
    }

    public function add_comment(Request $request)
    {
        if(Auth::id())
        {
            $comment = new Comment;

            $comment->name=Auth::user()->name;
            $comment->user_id=Auth::user()->id;
            $comment->comment=$request->comment;

            $comment->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function add_reply(Request $request)
    {
        if(Auth::id())
        {
            $reply = new Reply();
            $reply->name=Auth::user()->name;
            $reply->user_id=Auth::user()->id;

            $reply->comment_id=$request->commentId;
            $reply->Reply=$request->reply;

            $reply->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function product_search(Request $request)
    {
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();

        $search_text = $request->search;

        $product = Product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "%$search_text%")->paginate(10);

        return view('home.userpage', compact('product', 'comment', 'reply'));
    }

    public function product()
    {
        $product=Product::paginate(10);
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        return view('home.all_products', compact('product', 'comment', 'reply'));
    }

    
    public function search_product(Request $request)
    {
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();

        $search_text = $request->search;

        $product = Product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "%$search_text%")->paginate(10);

        return view('home.all_products', compact('product', 'comment', 'reply'));
    }
}
