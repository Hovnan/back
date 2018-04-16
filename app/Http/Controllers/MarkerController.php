<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;
use Auth;

class MarkerController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return response($user->markers);
    }
    public function store (Request $request)
    {
        $user = Auth::user();
        
        $markers = $user->markers()->create([
            'content' => $request->content,
            'coords' => $request->coords,
        ]);
        return response()->json(['status' => 'success', 'message' => 'MArker successfully added!'], 200);
    }

    public function update(Request $request, $id) {
        
        $marker = Marker::find($id);
        $marker->visited = true;
        $marker->save();
        
        return response()->json(['status' => 'success', 'message' => 'MArker successfully updated!'], 200);
    }
    public function destroy($id)
    {
        try {
            Marker::destroy($id);

            return response([], 204);
        }catch (\Exception $e){
            return response(['Problem with deleting the marker'], 500);
        }
    }
}
