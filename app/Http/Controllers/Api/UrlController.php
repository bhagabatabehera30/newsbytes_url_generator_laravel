<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\GeneratedUrl;

class UrlController extends Controller
{

    public function generateHashedUrl(Request $request)
    {
        try {
            $originalUrl = $request->input('url');

            // Validating the URL
            $request->validate([
                'url' => 'required|url',
            ]);

            // Creating Hash value of URL and stripping it upto 6 characters only
            $hash = substr(hash('sha256', $originalUrl),0,6);

            $checkUrl=GeneratedUrl::where('has_code',$hash)->first();
            if($checkUrl!=null){
             $url=$checkUrl;
             $hash=$url->has_code;
         }else{
           $url = new GeneratedUrl();
           $url->hased_url=url($hash);
           $url->has_code=$hash;
           $url->original_url=$originalUrl;
           $url->save();
       }
            // Save the URL with its Hash Value
       if($url->id) {
        return response()->json([
            'status'=>true,
            'generated_url' => url($hash)
        ], 201);
    } else {
        return response()->json([
            'status'=>false,
            'error' =>'',
            'message' => 'Something goes wrong. Please try after sometime.'
        ], 200);
    }

} catch (ValidationException $e) {
            // Throwing Error in case of URL is empty or not valid
    return response()->json([
        'status'=>false,
        'error' => $e->getMessage(),
    ], 200);
}
}

}
