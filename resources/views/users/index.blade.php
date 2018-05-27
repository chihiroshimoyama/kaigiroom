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
                    ユーザー一覧
                </div>

                <div class="panel-body">
                    @if (count($users) >0)
                    
                    <table class="table table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>氏名</th>
                                <th>email</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{!! link_to_route('users.show', $user->id, ['id' => $user->id]) !!}</td>
                                <td>{{$user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
    
                    {!! link_to_route('users.create', '新規ユーザーの登録', null, ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
    
@endsection