<?php

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function books()
    {
        return view('Library.web.books');
    }

    public function nearestLibraries(Request $request)
    {

        $location = json_decode($request->input('body'));
        $result = nearest_distances($location->lat, $location->lng, 'libraries');
        return response()->json(['status' => SUCCESS_STATUS, 'message' => 'locations have been fetched successfully', 'data' => $result]);

    }
}
