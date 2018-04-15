<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;
use Auth;

class MarkerController extends Controller
{
    //
    //public function __construct()
    //{
    //}
    public function index()
    {
        // $user = User::find(Auth::id());
        $user = Auth::user();
        // $markers = $user->markers;

        return response($user->markers);

        //if(count($product) > 0)
            return response()->json($product);

        // return response() -> json(['error' => 'Resourse not found!'], 404)
    }
    public function store (Request $request)
    {
        // $user = User::find($request->user_id);
        // $user = User::find(Auth::id());
        $user = Auth::user();
        
        $markers = $user->markers()->create([
            'content' => $request->content,
            'coords' => $request->coords,
        ]);
        return response()->json($markers);
    }
    // public function show($id)
    // {
    //     $user = Sentinel::getUser();
    //     $company = Company::find($id);
    //     //$role = Sentinel::findRoleById(3);
    //     /*$role->permissions = [
    //         "customer" => true,
    //         "employee" => true,
    //     ];
    //     $role->save();*/
    //     /*if($user->id == $company->user->id)
    //     {
    //         return view('companies.show')->withCompany($company);
    //     }
    //     return redirect()->back();*/
    //     $role = 'owner';
    //     return view('companies.show')->withUser($user)->withCompany($company)->withRole($role);
    // }

    public function update(Request $request, $id) {
        $marker = Marker::find($id);
        $marker->visited = true;
        $marker->save();
        
        return response()->json($marker);
    }
    public function destroy($id)
    {
        try {
            Marker::destroy($id);
            // $marker = App\Marker::find($id);

            // $marker->delete();
            return response([], 204);
        }catch (\Exception $e){
            return response(['Problem deleting the marker'], 500);
        }
            

        // return response() -> json(['error' => 'Resourse not found!'], 404)
        // return response() -> json(['error' => 'Resourse not found!'], 200)
    }
}
