<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Reservation;
use App\Room;

class CsvController extends Controller
{
    public function csv() 
    {
    $reservationcsvs = \DB::table('reservations')
                        //->where('reservations.id', '1')
                      
                        ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                        ->join('users', 'reservations.user_id', '=', 'users.id')
//                        ->select('reservations.kaiginame','reservations.startdate','reservations.enddate','reservations.number','rooms.roomname')
                        ->select(
                            "reservations.kaiginame",
                            \DB::raw("DATE_FORMAT(reservations.startdate, '%Y/%m/%d') AS startdate"),
                            \DB::raw("DATE_FORMAT(reservations.startdate, '%H:%i') AS starttime"),
                            \DB::raw("DATE_FORMAT(reservations.enddate, '%Y/%m/%d') AS enddate"),
                            \DB::raw("DATE_FORMAT(reservations.enddate, '%H:%i') AS endtime"),
                            "reservations.number",
                            "rooms.roomname"
                            )
                        ->get();

    /*
    for ($i = 0; $i < count($reservationcsvs); $i++)
    {
        $reservationcsvs[$i]->startdate = date("Y/m/d H:i:s", strtotime($reservationcsvs[$i]->startdate));
        $reservationcsvs[$i]->enddate = date("Y/m/d H:i:s", strtotime($reservationcsvs[$i]->enddate));
    }
    */

/*
    foreach ($reservationcsvs as $reservationcsv){
        
        $kaiginame = $reservationcsv->kaiginame;
        $startdate = date("Y/m",strtotime($reservationcsv->startdate));
        $starttime = date("H:i",strtotime($reservationcsv->startdate));
    }

    

    $reservationfcsvs = [$kaiginame,$startdate,$starttime];
*/
    
    $reservationcsvs = $reservationcsvs->toArray();

    $csvHeader = ['Subject', 'Start Date', 'Start Time', 'End Date', 'End Time', 'Description', 'Location'];
    array_unshift($reservationcsvs, $csvHeader);



    $stream = fopen('php://temp', 'r+b');
    foreach ($reservationcsvs as $reservationcsv) {
      fputcsv($stream, (array)$reservationcsv);
    }
    
    rewind($stream);
    
    $csv = str_replace(PHP_EOL,"\r\n",stream_get_contents($stream));
    $csv = mb_convert_encoding($csv,  'UTF-8');


    
    /*
    $headers = array(
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="reservations.csv"',
    );
    return Response::make('', 200, $headers);
    */

    

   return response($csv, 200)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="reservations.csv');


    
    }
}
