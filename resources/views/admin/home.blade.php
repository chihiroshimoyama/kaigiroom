@extends('layouts.app_admin')

@section('content')

    <div class="container">
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
        </div>
    </div>
    
    
@endsection
