<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Notifications\Action;
use Throwable;

class ActivitiesController extends Controller
{
    public function getListActivities(Request $request){
        try {
            if($request->ajax()){
                return Activity::all();
            } 
        }catch(Throwable $e){
            report($e);
            return $e;
        }
        
    }
}
