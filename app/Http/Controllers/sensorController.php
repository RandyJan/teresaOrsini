<?php

namespace App\Http\Controllers;

use App\Models\logs;
use App\Models\sensorData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class sensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $res = sensorData::get();
        return response()->json($res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Log::info($request->all());
        //
        $res = sensorData::where('room', $request['room'])->update([
            'humidity' => $request['humidity'],
            'temperature' => $request['temperature'],
            'smoke' => $request['smoke'],
            'motion' => $request['motion']
        ]);
        $dt = Carbon::now('Asia/Singapore')->format('m/d/Y H:i:s');
        if ($request['smoke'] == 1) {
            logs::insert(['room' => 1, 'action' => 'Gas/smoke dectected', 'dt' => $dt]);
        }
        if ($res) {
            return response()->json([
                'statusCode' => 200,
                'message' => 'success',
            ], 200);
        }
        return response()->json([
            'statusCode' => 500,
            'message' => 'failed',
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getLogs(){
        $rooms = sensorData::get();
    $roomCount = Count($rooms);
    $roomlogs=[];
    for($i = 1;$i<$roomCount;$i++){
        $res = logs::select('action','dt')->where('room',$i)->get();
        $roomlogs[]=['room'=>$i,
        'data'=>$res];
    }
    return response()->json(
        $roomlogs
    );
    }
}
