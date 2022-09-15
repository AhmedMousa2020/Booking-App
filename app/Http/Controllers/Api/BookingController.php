<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
   
    public function store(Request $request){

        $this->checkCapapelty($request->type,$request->customers_number);
        

        $discount = 0.95;

        $room_price = Room::where('hotel_id',$request->hotel_id)->where('branch_id',$request->branch_id)->pluck('price')->first();
       
        $Check_customer = Customer::where('email',$request->email)->first();
        
        if($Check_customer && $Check_customer->hotel_id == $request->hotel_id){
            // get room price 
            (float)$room_price = (float)$room_price - ((float)$room_price * (float)$discount); 
            $customer_id = $Check_customer->id; 
        }else{
            // register customer
            $customer = new Customer();
            $customer->name = $request->customer_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->hotel_id = $request->hotel_id;
            $customer->rooms_number = $request->rooms_number;
            $customer->save();
            
            $customer_id = $customer->id;
        }
        $rooms_num = $request->rooms_number;
        

        while( $rooms_num > 0){
        
            $type = $this->getRoomType($request->room_type);
            
            $room = $this->checkAvailablity($type,$request->hotel_id,$request->branch_id);
            
            $booking = new Booking();
            $booking->user_id = $request->user_id;
            $booking->customer_id = $customer_id;
            $booking->room_id = $room->id;
            $booking->customers_number = $request->customers_number;
            $booking->discount_price = $room_price;
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;
            $booking->save();
            

            $room->status = 0;
            $room->booking_id = $booking->id;
            $room->save();
            $rooms_num--;
        }
        $result = Booking::find($booking->id)->first();
        return response()->json($result);
    }

    public function find(Request $request){
        $result=[];
        $rooms = Room::all();
        foreach($rooms as $room){
            $booking_room = Booking::where('room_id',$room->id)->first();
            if($booking_room){
                if($request->start_date > $booking_room->end_date);{
                    $result[]='The Room number '.$booking_room->room_id . ' is Avilabel in '. $request->start_date;
                }
            }else{
                $result[] = 'The Room number '.$room->id . ' is Avilabel Now';
            }
        }
        return response()->json($result);
    }
    
    public function update(Request $request){
        
        $old_room = Room::where('booking_id',$request->booking_id)->first();
        if(isset($request->room_id)){
            $room = Room::find($request->room_id);
            $type = $this->getRoomType($request->room_type);
            if($room->type == $type && $room->status == 1){
                $room->booking_id = $request->booking_id;
                $room->status = 0;
                $room->save();

                $old_room->status = 1;
                $old_room->booking_id = 0;
                $old_room->save();
                return;
            }else{
                return response()->json('This Room Not Avilabel');
            }
        }
        $booking = Booking::find($request->booking_id);
        $old_room->booking_id = 0;
        $old_room->status = 1;
        $old_room->save();
        //user_id
        $booking->user_id = $request->user_id;
        //change_room
        $type = $this->getRoomType($request->room_type);
        $room_info = $this->checkAvailablity($type,$request->hotel_id,$request->branch_id);
        $this->checkCapapelty($room_info->type,$request->customers_number);
        $room_info->booking_id = $request->booking_id;
        $room_info->hotel_id = $request->hotel_id;
        $room_info->branch_id = $request->branch_id;
        $room_info->status = 0;
        $room_info->save();

        $booking->room_id = $room_info->id;
        //customers_number
        $booking->customers_number = $request->customers_number;
        //discount_price
        $booking->discount_price = $room_info->price;
        //start_date
        $booking->start_date = $request->start_date;
        //end_date
        $booking->end_date = $request->end_date;

        $booking->save();
    }

    public function checkAvailablity($type,$hotel_id,$branch_id){
       // $type = $this->getRoomType($type);
        $room = Room::where('status',1)->where('type',$type)->where('hotel_id',$hotel_id)->where('branch_id',$branch_id)->first();
            if(!$room){
                return response()->json('no Rooms Available');
            }
            return $room;
    }
    public function checkCapapelty($type,$customers_number){
        if(!strcasecmp($type, 'single') && $customers_number > 1 ){
            return response()->json('too much for this room');
        }elseif(!strcasecmp($type, 'double') && $customers_number > 2 ){
            return response()->json('too much for this room');
        }
    }

    public function getRoomType($room_type){
         // get empty room
         
         if(!strcasecmp($room_type, 'single')){
            $type = 0; 
         }elseif(!strcasecmp($room_type, 'double')){
             $type = 1;
         }elseif(!strcasecmp($room_type, 'suite')){
             $type = 2;
         }

         return $type;
    }


    public function delete(Request $request){
        //$rooms = Room::where('customer_id',$request->customer_id)->get();
        $bookings = Booking::where('customer_id',$request->customer_id)->get();
        foreach($bookings as $booking){
            $room = Room::find($booking->room_id);
            $room->status = 1;
            $room->booking_id = 0;
            $room->save();
        } 
        $booking->delete();

        $customer = Customer::find($request->customer_id);
        $customer->delete();
        return response()->json('booking has been canceled');

    }
}
