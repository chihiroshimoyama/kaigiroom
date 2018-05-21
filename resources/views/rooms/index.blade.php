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
                    Menu

    <h1>ユーザー一覧</h1>

    @if (count($rooms) >0)
        <table class="table table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>会議室名</th>
                    <th>定員</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{!! link_to_route('rooms.show', $room->id, ['id' => $room->id]) !!}</td>
                        <td>{{$room->roomname }}</td>
                        <td>{{ $room->number }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {!! link_to_route('rooms.create', '新規会議室の登録', null, ['class' => 'btn btn-primary']) !!}
    
@endsection