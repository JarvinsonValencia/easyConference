<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meet;
use Exception;
use Throwable;

class MeetingsController extends Controller
{
    public function getListMeetings($role_id, $client_id){
        try {
            $listMeets = array();
           
                $meet = Meet::all();
                    foreach($meet as $m){
                        if($role_id == 1) {
                            array_push($listMeets, $m);
                        }
                        else if($m->client_id == $client_id){
                           array_push($listMeets, $m);
                        }
                    }
            return $listMeets;
        }catch(Throwable $e){
            return $e;
        }
    }

    public function getMeet($id) {
        try {
            $meet = Meet::findOrFail($id);
            return response()->json($meet);
        }catch(Exception $e){
            return $e;
        }
    }

    public function setCreateMeet(Request $request){

        try {
            $meet = new Meet();
            $meet->title = $request->title;
            $meet->date = $request->date;
            $meet->purpose = $request->purpose;
            $meet->client_id = $request->client_id;
            $meet->end_date = now();
            
            $meet->save();
            return response()->json($meet);
        }catch(Exception $e){
            return $e;
        }
    }

    public function editMeet(Request $request, $id) {
        try{
            $meet = Meet::findorFail($id);
            $meet->title = $request->title;
            $meet->date = $request->date;
            $meet->purpose = $request->purpose;
            $meet->client_id = (int)$request->client_id;
            $meet->end_date = now();
            $meet->save();
            return response()->json($meet);
        }catch(Exception $e){
            return $e;
        }
    }

    public function deleteMeet($id) {
        try {
            $meet = Meet::find($id);
            $meet->delete();
       }catch(Exception $e) {
           return $e;
       }
    }
}
