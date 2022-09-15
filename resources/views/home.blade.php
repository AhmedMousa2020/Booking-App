@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" style="max-width:115%;width:115%">
                <div class="card">
                    <div class="card-header">{{ __('Rooms Report') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"># Room ID</th>
                                    <th scope="col">Hotel name</th>
                                    <th scope="col">Branch name</th>
                                    <th scope="col">Branch Adress</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Customer Email</th>
                                    <th scope="col">Customer Phone</th>
                                    <th scope="col">Customers Number</th>
                                    <th scope="col">From</th>
                                    <th scope="col">TO</th>
                                    <th scope="col">Charge Employee</th>
                                    <th scope="col">Room Price</th>
                                    <th scope="col">After (95%) Discount</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Room Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td >{{$room->id}}</td>
                                    <td >{{$room->hotel_rooms->name}}</td>
                                    <td>{{$room->branch_rooms->name}}</td>
                                    <td>{{$room->branch_rooms->address}}</td>
                                    
                                    <td>
                                        @if(isset($room->booking_room->customer_id))
                                            {{\App\Models\Customer::where('id',$room->booking_room->customer_id)->pluck('name')->first()}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($room->booking_room->customer_id))
                                            {{\App\Models\Customer::where('id',$room->booking_room->customer_id)->pluck('email')->first()}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($room->booking_room->customer_id))
                                            {{\App\Models\Customer::where('id',$room->booking_room->customer_id)->pluck('phone')->first()}}
                                        @endif
                                    </td>
                                    <td >
                                        @if(isset($room->booking_room->customer_id))
                                            {{$room->booking_room->customers_number}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($room->booking_room->start_date))
                                            {{$room->booking_room->start_date}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($room->booking_room->end_date))
                                            {{$room->booking_room->end_date}}
                                        @endif
                                    </td>
                                    <td >
                                        @if(isset($room->booking_room->user_id))
                                            {{\App\Models\User::where('id',$room->booking_room->user_id)->pluck('name')->first()}}
                                        @endif
                                    </td>
                                    <td>{{$room->price}}</td>
                                    <td>
                                        @if(isset($room->booking_room->discount_price))
                                            {{$room->booking_room->discount_price}}
                                        @endif
                                    </td>
                                    <td>


                                    @if($room->type == 0)
                                        <span>Single</span>
                                    @elseif($room->type == 1)
                                        <span>Double</span>
                                    @elseif($room->type == 2)
                                        <span>Suite</span>
                                    @endif
                                    </td>
                                    <td>
                                    @if($room->status == 0)
                                        <span class="text-danger">Booked</span>
                                    @else
                                        <span class="text-success">Available</span>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                                
                            </tbody>
                        </table>
                        {{$rooms->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
