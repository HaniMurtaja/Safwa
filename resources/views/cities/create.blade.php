@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">{{ trans('cities.create') }}</h1>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('cities.city.index') }}" class="btn btn-primary" title="{{ trans('cities.show_all') }}">
            <i class="fas fa-list-alt"></i>
        </a>
    </div>
@stop

@section('content')

    <div class="panel panel-default">

<div class="card card-primary card-outline">
    <div class="card-body">

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('cities.city.store') }}" accept-charset="UTF-8" id="create_city_form" name="create_city_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('cities.form', [
                                        'city' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('cities.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>
    </div>
    </div>

@endsection


