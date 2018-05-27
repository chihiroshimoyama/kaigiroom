@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <!-- left -->
            <div class="col-md-5 col-md-offset-3">
                <!-- パネルで囲む -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        会議室予約システム
                    </div>
                    
                    <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        <li>{!! link_to_route('reservations.index', '予約検索・入力画面へ') !!}</li>
                        
           
                    </ul> 
                    </div>
                </div>
                
            </div>
        </div>
        
        
        
        
    </div>
@endsection

