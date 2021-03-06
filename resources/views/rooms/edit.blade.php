@extends('layouts.app_admin')

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
                    <li>{!! link_to_route('users.index', 'ユーザー一覧') !!}</li>
                    <li>{!! link_to_route('rooms.index', '会議室一覧') !!}</li>
                </ul> 
                <!-- </div> -->
            </div>
        </div>
        
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    id: {{ $room->id }} の会議室編集
                </div>
                    
                <div class="panel-body">
                    {!! Form::model($room, ['route' => ['rooms.update', $room->id], 'method' => 'put']) !!}
                            <div class="form-group">
                             {!! Form::label('roomname', '会議室名:') !!}
                             {!! Form::text('roomname', null, ['class' => 'form-control']) !!}
                            </div>
        
                            <div class="form-group">
                             {!! Form::label('number', '定員:') !!}
                             {!! Form::text('number', null, ['class' => 'form-control']) !!}
                            </div>

                     {!! Form::submit('更新', ['class' => 'btn btn-default']) !!}
         
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection