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
        
        
        <div class="col-md-9">
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
                        
                        {!! $reservations->appends(['room_id' => $search_query['room_id'], 'date' => $search_query['date']])->render() !!}
                    @endif
    
                   
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    会議時間
                </div>
            
                <div class="panel-body">
                    @if (count($reservations) >0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>会議室名</th>
                                    <th>会議名</th>
                                    <th>予約者</th>
                                    <th>日時</th>
                                    <th>8時</th>
                                    <th>9時</th>
                                    <th>10時</th>
                                    <th>11時</th>
                                    <th>12時</th>
                                    <th>13時</th>
                                    <th>14時</th>
                                    <th>15時</th>
                                    <th>16時</th>
                                    <th>17時</th>
                                    <th>18時</th>
                                    <th>19時</th>
                                    <th>20時</th>
                                    <th>21時</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->roomname }}</td>
                                    <td>{{ $reservation->kaiginame }}</td>
                                    <td>{{ $reservation->name }}</td>
                                    <td>{{ date('m/d',strtotime($reservation->startdate)) }}</td>
                                    @if('08' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '08')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    
                                    @if('09' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '09')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('10' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '10')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('11' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '11')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('12' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '12')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('13' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '13')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('14' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '14')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('15' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '15')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('16' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '16')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('17' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '17')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('18' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '18')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('19' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '19')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('20' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '20')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                    @if('21' == date('H' , strtotime($reservation->startdate)) or date('H', strtotime($reservation->enddate)) == '21')
                                    <td bgcolor="#ff7f50">
                                    @else
                                    <td>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
    
                   
                </div>
            </div>


        </div>
    </div>
    
@endsection