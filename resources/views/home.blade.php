@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">{{__('dashboard.title')}}</h1>
@stop

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$total_cities}}</h3>

                <p>{{__('dashboard.total_title',['items'=>'cities'])}}</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('cities.city.index') }}" class="small-box-footer">{{__('dashboard.more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$total_drivers}}</h3>

                <p>{{__('dashboard.total_title',['items'=>'drivers'])}}</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('drivers.driver.index') }}" class="small-box-footer">{{__('dashboard.more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$total_bookings}}</h3>

                <p>{{__('dashboard.total_title',['items'=>'bookings'])}}</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('booking.index') }}" class="small-box-footer">{{__('dashboard.more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$total_trip}}</h3>

                <p>{{__('dashboard.total_title',['items'=>'trips'])}}</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('trip.index') }}" class="small-box-footer">{{__('dashboard.more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-2 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{$total_customers}}</h3>

                <p>{{__('dashboard.total_title',['items'=>'customers'])}}</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('customer.index') }}" class="small-box-footer">{{__('dashboard.more_info')}} <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <!-- ./col -->
</div>
<div class="row">
    <div class="col">
        {{-- <drivers :user="{{ auth()->user() }}"></drivers> --}}




    </div>
</div>
{{-- <div class="row">
    <div class="col">
        <div id="map_container"></div>
        <div id="map"></div>
    </div>
</div> --}}
<!-- /.row -->
@stop
{{-- @section('js')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-q1JYVn8f510Ta_pZPI0iOHcFpBFshMY"
    defer></script>
@stop --}}
