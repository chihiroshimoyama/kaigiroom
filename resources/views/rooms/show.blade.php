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
        
        <div class="col-xs-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Menu

    <h1>id = {{ $room->id }} のユーザー詳細ページ</h1>
    
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $room->id }}</td>
        </tr>
        <tr>
            <th>会議室名</th>
            <td>{{ $room->roomname }}</td>
        </tr>
        <tr>
            <th>number</th>
            <td>{{ $room->number }}</td>
        </tr>

    </table>
    

    
    {!! link_to_route('rooms.edit', 'この会議室の編集', ['id' => $room->id], ['class' => 'btn btn-default']) !!}
    
    {!! Form::model($room, ['route' => ['rooms.destroy', $room->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection