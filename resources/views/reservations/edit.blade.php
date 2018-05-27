@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- left -->
        <div class="col-md-3">
            <!-- パネルで囲む -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Menu
                </div>
                <!-- 敢えてbodyを作らないことで、メニューを詰める -->
                <!-- <div class="panel-body"> -->
                <ul class="nav nav-pills nav-stacked">
                    <li>{!! link_to_route('reservations.index', 'すべての予約一覧') !!}</li>
                    
                </ul> 
                <!-- </div> -->
            </div>
        </div>
        
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    id: {{ $reservation->id }} の会議室編集
                </div>
                    
                <div class="panel-body">
                    <h1>会議室名: {{ $reservation->roomname }}</h1>
                    {!! Form::model($reservation, ['route' => ['reservations.update', $reservation->id], 'method' => 'put']) !!}
                            <div class="form-group">
                             {!! Form::label('number', '予約人数:') !!}
                             {!! Form::text('number', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                             {!! Form::label('startdate', '開始時間:') !!}
                             {!! Form::text('startdate', null, ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group">
                             {!! Form::label('endtdate', '開始時間:') !!}
                             {!! Form::text('enddate', null, ['class' => 'form-control']) !!}
                            </div>
                     {!! Form::submit('更新', ['class' => 'btn btn-default']) !!}
         
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection