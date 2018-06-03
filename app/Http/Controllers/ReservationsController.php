<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Reservation;
use App\Room;


class ReservationsController extends Controller
{
    public function index()
    {
        $reservations = \DB::table('reservations')
                        ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                        ->join('users', 'reservations.user_id', '=', 'users.id')
                        ->select('reservations.*', 'users.name', 'rooms.roomname')
                        ->orderBy('startdate','DESC')
                        ->paginate(20);
        
        $reservation = new Reservation;
        $rooms = Room::all();
        
        return view('reservations.index', [
            'reservations' => $reservations,
            'reservation' => $reservation,
            'rooms' => $rooms,
        ]);
    }
    
    public function getIndex(Request $request)
    {
        // 検索するテキスト取得
        $searchroom = $request->get('room_id');
        $searchdate = $request->get('date');
        // 日付が入っていなかったら、where句の条件をはずして、会議室のみ指定して、日付は全て表示させる
        
        if(empty($searchdate)){

       
        
            $reservation = new Reservation;
            $rooms = Room::all();

            $reservations = \DB::table('reservations')
                            ->where('room_id', $searchroom)

                            
                            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                            ->join('users', 'reservations.user_id', '=', 'users.id')
                            ->select('reservations.*', 'users.name', 'rooms.roomname')
                            ->orderBy('startdate','DESC')
                            ->paginate(10);


                            
            
        }elseif(empty($searchroom)){      
        
        
        $reservation = new Reservation;
        $rooms = Room::all();
        
        $reservations = \DB::table('reservations')
                        
                        ->whereDate('startdate',$searchdate)
                        ->whereDate('enddate',$searchdate)
                        ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                        ->join('users', 'reservations.user_id', '=', 'users.id')
                        ->select('reservations.*', 'users.name', 'rooms.roomname')
                        ->orderBy('startdate','DESC')
                        ->paginate(10);
                            
        
        }else{      
        
        
        $reservation = new Reservation;
        $rooms = Room::all();
        
        $reservations = \DB::table('reservations')
                        ->where('room_id', $searchroom)
                        ->whereDate('startdate',$searchdate)
                        ->whereDate('enddate',$searchdate)
                        ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                        ->join('users', 'reservations.user_id', '=', 'users.id')
                        ->select('reservations.*', 'users.name', 'rooms.roomname')
                        ->orderBy('startdate','DESC')
                        ->paginate(10);
                        
        
        }
        
        return view('reservations.getIndex', [
            'reservations' => $reservations,
            'reservation' => $reservation,
            'rooms' => $rooms,
            'search_query' => ['room_id' => $searchroom, 'date' => $searchdate],
            
        ]);
    }
    
    
    public function show($id)
    {
        $reservation = \DB::table('reservations')
                        ->where('reservations.id', '=', $id)
                        ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                        ->join('users', 'reservations.user_id', '=', 'users.id')
                        ->select('reservations.*', 'users.name', 'rooms.roomname')
                        ->first();
        

        return view('reservations.show', [
            'reservation' => $reservation,
        ]);
    }
    

    
    public function store(Request $request)
    {
    
        $reservations = \DB::table('reservations')
                        ->where('room_id',  '=', $request->room_id)
                        ->where('startdate', '<=',($request->date . ' '. $request->endtime . ':00'))
                        ->where('enddate', '>=', ($request->date .' '. $request->starttime . ':00'))
                        ->select('reservations.*')
                        ->get();
        
        if (count($reservations) >0){
            
                return redirect()->back()->with('message', '予約が重複しています');
            } else {
                
                    $reservation = new Reservation;
                    $reservation->user_id = \Auth::user()->id;
                    $reservation->room_id = $request->room_id;
                    $reservation->number = $request->number;
                    $reservation->kaiginame = $request->kaiginame;
                    $reservation->startdate = $request->date .' '. $request->starttime . ':00';
                    $reservation->enddate = $request->date . ' '. $request->endtime . ':00';
                    $reservation->save();

                    return redirect('/reservations');
        }
    }
        
        
                        

  
    
    public function edit($id)
    {
        $reservation = \DB::table('reservations')
                        ->where('reservations.id', '=', $id)
                        ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                        ->join('users', 'reservations.user_id', '=', 'users.id')
                        ->select('reservations.*', 'users.name', 'rooms.roomname')
                        ->first();

        return view('reservations.edit', [
            'reservation' => $reservation,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->number = $request->number;
        $reservation->startdate = $request->startdate;
        $reservation->enddate = $request->enddate;
        $reservation->save();

        return redirect('/reservations');
    }
    
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect('/reservations');
    }
}
