<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Administration\Exception;
use Illuminate\Http\Request;
use App\Models\Person;

class PersonsController extends Controller
{
    public function getListPersons(Request $request){
        if($request->ajax()){
            return Person::all();
        }
    }

    public function getPerson($id) {
        $person = Person::findOrFail($id);
        return response()->json($person);
    }

    public function setCreatePerson(Request $request) {
        try {
            $record = new Person;
            $record->name = $request->name;
            $record->document = $request->document;
            $record->email = $request->email;
            $record->phone = $request->phone;
            $record->save();
        
        } catch (Exception $e){
            echo $e->getMessage();
        }
        
        return $record;
    }

    public function editPerson(Request $request, $id) {
        $record = Person::findOrFail($id);
        $record->name = $request->name;
        $record->document = $request->document;
        $record->email = $request->email;
        $record->phone = $request->phone;
        $record->save();

        return response()->json($record);
    }
}
