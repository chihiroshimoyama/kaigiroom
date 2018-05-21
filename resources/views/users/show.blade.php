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
                    <li><a href="">submenu2</a></li>
                </ul> 
                <!-- </div> -->
            </div>
        </div>
        
        <div class="col-xs-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Menu

    <h1>id = {{ $user->id }} のユーザー詳細ページ</h1>
    
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>氏名</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>password</th>
            <td>{{ $user->password }}</td>
        </tr>
    </table>
    

    
    {!! link_to_route('users.edit', 'このユーザーの編集', ['id' => $user->id], ['class' => 'btn btn-default']) !!}
    
    {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection