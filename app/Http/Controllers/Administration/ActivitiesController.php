<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Notifications\Action;
use Throwable;
use Exception;

class ActivitiesController extends Controller
{
    public function getListActivities($client_id){
        try {
                $activity = Activity::all();
                $listActivity = array();

                foreach($activity as $a) {
                    try {
                        $user = User::find($a->user_id);
                        if($user->client_id == $client_id){
                            $a->user_id = $user->name;
                            array_push($listActivity, $a);
                        }
                    }catch(Exception $e) {
                        return $e;
                    }
                }
                return $listActivity;
        }catch(Exception $e){
            return $e;
        }
    }

    public function setCreateActivity(Request $request) {
        try {
            $activity = new Activity();
            $activity->name = $request->name;
            $activity->description = $request->description;
            $activity->estimated_date = now();
            $activity->user_id = $request->user_id;
            
            $activity->save();
            return response()->json($activity);
        }catch(Exception $e){
            return $e;
        }
    }

    public function editActivity(Request $request, $id) {
        try {
            $activity = Activity::findorFail($id);
            $activity->name = $request->name;
            $activity->description = $request->description;
            $activity->estimated_date = now();
            $activity->user_id = $request->user_id;
            
            $activity->save();
            return response()->json($activity);
        }catch(Exception $e){
            return $e;
        }
    }

    public function deleteActivity($id) {
        try {
            $activity = Activity::find($id);
            $activity->delete();
       }catch(Exception $e) {
           return $e;
       }
    }
}
