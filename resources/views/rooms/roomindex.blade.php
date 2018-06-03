@extends('layouts.app')

@section('content')
    <div class="row">

        
        
        <div class="col-xs-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    会議室一覧
                </div>
            
                <div class="panel-body">
                    @if (count($rooms) >0)
                        <table class="table table table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>会議室名</th>
                                    <th>定員</th>
                                    <th>写真</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $room->id }}</td>
                                    <td>{{ $room->roomname }}</td>
                                    <td>{{ $room->number }}</td>
                                    <td>
                                        <?php $pic = "pic/$room->id.jpg" ?>
                                        <img src="{{ secure_asset( $pic ) }}" alt="kaigiroom">
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