<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneratedUrl;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function redirect($hash)
    {
        // Get the Original URL on the basis of Hash.
        $url = GeneratedUrl::where('has_code', $hash)->first();
        if($url==null) {
            return response()->json([
                'error' => 'URL not found'
            ], 404);
        }

        // Redirect to original URL
        return redirect($url->original_url);
    }


    
}
