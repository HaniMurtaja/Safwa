<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Booking;
use App\Models\Trip;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use Illuminate\Support\Facades\App;

class WebsiteController extends Controller
{
   
    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

  
    public function index()
    {
        $roles = auth()->user()->getRoleNames();

        $total_customers = User::where('user_type_id',4)->count();;
        $total_cities = City::count();
        $total_drivers = User::where('user_type_id',3)->count();
        $total_bookings = Booking::count();
        $total_trip = Trip::count();

        return view('home', compact('total_customers','total_cities','total_drivers','total_bookings','total_trip'));
    }
}
