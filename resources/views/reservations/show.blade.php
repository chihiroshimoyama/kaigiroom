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
        
        <div class="col-xs-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    id = {{ $reservation->id }} の予約詳細
                </div>
                
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>id</th>
                            <td>{{ $reservation->id }}</td>
                        </tr>
                        <tr>
                            <th>会議室名</th>
                            <td>{{ $reservation->roomname }}</td>
                        </tr>
                        <tr>
                            <th>予約人数</th>
                            <td>{{ $reservation->number }}</td>
                        </tr>
                        <tr>
                            <th>開始時間</th>
                            <td>{{ $reservation->startdate }}</td>
                        </tr>
                        <tr>
                            <th>終了時間</th>
                            <td>{{ $reservation->enddate }}</td>
                        </tr>
                    </table>
                    {!! link_to_route('reservations.edit', 'この予約の編集', ['id' => $reservation->id], ['class' => 'btn btn-default']) !!}
                    {!! Form::model($reservation, ['route' => ['reservations.destroy', $reservation->id], 'method' => 'delete']) !!}
                    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    
@endsection