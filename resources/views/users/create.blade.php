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
            
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Menu
        
                        {!! Form::model($user, ['route' => 'users.store']) !!}

                            <div class="form-group">
                                {!! Form::label('name', '名前:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'email:') !!}
                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                            </div>
                
                            <div class="form-group">
                                {!! Form::label('password', 'password:') !!}
                                {!! Form::text('password', null, ['class' => 'form-control']) !!}
                            </div>

                            {!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        
@endsection
