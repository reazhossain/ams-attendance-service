<?php

namespace App\Http\Controllers;


use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{

    public function pushToServer()
    {
		$urls = [
		"http://olea.amsseed.com/api/attendance/receive-attendance-from-other-service", 
		"http://hsd.amsseed.com/api/attendance/receive-attendance-from-other-service", 
		"http://bangebank.amsseed.com/api/attendance/receive-attendance-from-other-service"];
		
		
		foreach($urls as $url){
			 // $attendances = Attendance::where("is_pushed", 0)->get();
				$attendances = Attendance::where("is_pushed", 0)->orderBy('id', 'desc')->take(500)->get();
				
				
				$post = [
					'attendances' => $attendances
					/* 'password' => 'passuser1',
					 'gender'   => 1,*/
				];

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

				// execute!
				$response = curl_exec($ch);

				// close the connection, release resources used
				curl_close($ch);

				// do anything you want with your response
				$response = json_decode($response, false);

				if ($response->success) {
					$successIds = $response->message;
					Attendance::whereIn("id", $successIds)->update(['is_pushed' => 1]);
					

				} else {
					Log::critical('Error ' . $response->message);
					dd($response->message);
				}
		}
       

    }


    public function getAllAttendance($from, $to, $pin = null)
    {

        try {
            $fromDate = Carbon::parse($from)->toDateString();
            $toDate = Carbon::parse($to)->toDateString();

            if ($fromDate && $toDate) {
                $attendances = Attendance::whereDate('punch_time', '>=', $fromDate)->whereDate('punch_time', '<=', $toDate);

                if ($pin) $attendances->where("emp_code", $pin);

                return $attendances->get();
            } else {
                return response()
                    ->json(['success' => false, 'message' => "Failed"]);
            }
        } catch (\Exception $e) {

            return response()
                ->json(['success' => false, 'message' => "Failed" . $e->getMessage()]);
        }


    }


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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
