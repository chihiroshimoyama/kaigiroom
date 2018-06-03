@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- left -->
        <div class="col-md-3">
            <!-- パネルで囲む -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    検索条件
                </div>
                <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li>{!! link_to_route('reservations.index', 'すべての予約一覧') !!}</li>
                    <li>
                        {!! Form::open(['route' => 'reservations.getIndex','method' => 'GET']) !!}
                            <div class="form-group">
                                {!! Form::label('room_id', '会議室名:') !!}
                                {!! Form::select('room_id', $rooms->pluck('roomname', 'id'), 'null', ['class' => 'form-control' ,'placeholder' => '会議室名']) !!}
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('date', '日付:') !!}
                                {!! Form::text('date', null, ['id' => 'datepicker' , 'class' => 'form-control']) !!}
                            </div>
                            
                    {!! Form::submit('検索', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
                    </li>
                </ul> 
                
                </div>
            </div>
        
            <div class="panel panel-default">
                <div class="panel-heading">
                    予約入力
                </div>
                
                <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    @if (session('message'))
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="alert alert-warning">
                                {{ session('message') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <li>
                        {!! Form::model($reservation, ['route' => 'reservations.store']) !!}
                            <div class="form-group">
                                {!! Form::label('room_id', '会議室名:') !!}
                                {!! Form::select('room_id', $rooms->pluck('roomname', 'id'), 'null', ['class' => 'form-control' ,'placeholder' => '会議室名']) !!}
                                {!! link_to_route('roomindex', '会議室情報', null, ['class' => 'btn btn-primary']) !!}
                            </div>
                            
                            
                            
                            <div class="form-group">
                                {!! Form::label('number', '人数:') !!}
                                {!! Form::text('number', null, ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('kaiginame', '会議名:') !!}
                                {!! Form::text('kaiginame', null, ['class' => 'form-control']) !!}
                            </div>
                            

                            
                            <div class="form-group">
                                {!! Form::label('date', '日付:') !!}
                                {!! Form::text('date', null, ['id' => 'datepicker2' , 'class' => 'form-control']) !!}
                            </div>
 
                            <div class="form-group">
                                {!! Form::label('starttime', '開始時間:') !!}
                                {!! Form::time('starttime', null, ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('endtime', '終了時間:') !!}
                                {!! Form::time('endtime', null, ['class' => 'form-control']) !!}
                            </div>
                            
                            


                    {!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
                    </li>
   
                </ul> 
                </div>
            </div>
        </div>
        
        
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    予約一覧
                </div>
            
                <div class="panel-body">
                    @if (count($reservations) >0)
                        <table class="table table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>会議室名</th>
                                    <th>人数</th>
                                    <th>会議名</th>
                                    <th>予約開始時間</th>
                                    <th>予約終了時間</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{!! link_to_route('reservations.show', '編集', ['id' => $reservation->id], ['class' => 'btn btn-danger']) !!}</td>
                                    <td>{{ $reservation->roomname }}</td>
                                    <td>{{ $reservation->number }}</td>
                                    <td>{{ $reservation->kaiginame }}</td>
                                    <td>{{ $reservation->startdate }}</td>
                                    <td>{{ $reservation->enddate }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
    
                 {!! $reservations->render() !!}  
                </div>
            </div>


        </div>
    </div>
    
@endsection