<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Ashadozzaman\Coupon\Http\Traits\CouponGenerate;
class HomeController extends Controller
{
    use CouponGenerate;

    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin.adminHome');
    }


    public function get_course(){
        $data['courses'] = Course::get();
        // dd($data['courses']);
        return view('courses',$data);
    }

    public function checkout_course(Request $request,$id = null){
        $data['course'] = Course::findOrFail($id);
        $course = Course::findOrFail($id);
        if($request->coupon){
            $coupon = $request->coupon;
            $item = $id;
            $item_category = $course->category->id;
            $customer_id = auth()->user->id; //user, student, customer //login user
            $response = $this->checkCoupunStatus($coupon,$item,$item_category,$customer_id);
            if($response['status'] == "error"){
                Session::flash('message',$response['message']);
                return redirect()->back();
            }else{
                $data['coupon'] = $response;
            }
            //must be call with 4 perameter 1.coupon 2. coupon item id(course) 3.item category id 4.Customer id

        }
        return view('checkout',$data);

    }

    public function checkout_submit(Request $request){
        $data['customer_id'] = auth()->user->id;;//login user id
        $data['course_id'] = $request->course_id;
        $data['price'] = $request->price;
        $booking = Booking::create($data);
        if(isset($booking)){
            if($request->coupon){
                $response = $this->useCouponByUser($data['customer_id'],$request->coupon);//must be pass 2 perameter customer_id(login user id),coupon_code;
            }
        }
        Session::flash('message',"Booking Successfull");
        return redirect()->back();
    }
}
