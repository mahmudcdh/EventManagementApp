<?php

namespace App\Http\Controllers;

use App\Models\event;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function eventsList(){
        return view('event.eventsList');
    }

    public function addEvent(){
        return view('event.addEvent');
    }

    public function apiEventsList(Request $request){
        $events = auth()->user()->events()->get();
        return response()->json($events, 200);
    }

    public function apiEventView(){

    }

    public function eventCreate(){
        $validatedData = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'event_datetime' => 'required|date',
            'location' => 'required|string',
        ]);
        try{
            auth()->user()->events()->create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Event created successfully'
            ], 200);
        }
        catch (Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something went wrong..!'
            ], 200);
        }
    }

    public function eventUpdate(Request $request, Event $event){
        $validatedData = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'event_datetime' => 'required|date',
            'location' => 'required|string',
        ]);

        try{
            $event->update($validatedData);
            return response()->json([
                'status'=>'success',
                'message' => 'Event updated successfully'
            ], 200);
        }
        catch (Exception $e){
            return response()->json([
                'status'=>'fail',
                'message'=>'Something went wrong..!'
            ], 200);
        }
    }

    public function destroy(Event $event){
        try{
            $event->delete();
            return response()->json([
                'status'=>'success',
                'message' => 'Deleted successfully..!'
            ], 200);
        }
        catch (Exception $e){
            return response()->json([
                'status'=>'fail',
                'message' => 'Something went wrong..!'
            ], 200);
        }
    }
}
