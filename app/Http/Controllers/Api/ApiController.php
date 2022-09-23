<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Course;
use Ashadozzaman\Coupon\Http\Traits\CouponGenerate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\Token;
class ApiController extends Controller
{

    use CouponGenerate;

    public function get_course(){
        $courses = Course::get();
        return response(['courses' =>$courses,'message'=>'Get courses'], Response::HTTP_OK);
    }

    public function checkout_course(Request $request,$id = null){
        $user = Auth::user()->token();
        $id = $request->id;
        $data['course'] = Course::findOrFail($id);
        $course = Course::findOrFail($id);
        if($request->coupon){
            $coupon = $request->coupon;
            $item = $id;
            $item_category = $course->category->id;
            $customer_id = $user->user_id; //user, student, customer //login user
            $response = $this->checkCoupunStatus($coupon,$item,$item_category,$customer_id);
            if($response['status'] == "error"){
                return response([
                    'error' => $response['message']
                ], 400);
            }else{
                $data['coupon'] = $response;
            }
            //must be call with 4 perameter 1.coupon 2. coupon item id(course) 3.item category id 4.Customer id

        }
        // return view('checkout',$data);

        return response(['data' =>$data], Response::HTTP_OK);

    }

    public function checkout_submit(Request $request){
        // return response(['message' =>$request->all()], Response::HTTP_OK);
        $user = Auth::user()->token();
        $data['customer_id'] = $user->user_id;//login user id
        $data['course_id'] = $request->course_id;
        $data['price'] = $request->price;
        $booking = Booking::create($data);
        if(isset($booking)){
            if($request->coupon != null){
                $response = $this->useCouponByUser($data['customer_id'],$request->coupon);//must be pass 2 perameter customer_id(login user id),coupon_code;
            }
        }

        return response(['message' =>'Booking successfull'], Response::HTTP_OK);
    }
}
