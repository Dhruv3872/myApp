<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Model:
use App\Models\secret;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProcessDataController extends Controller
{
    public function saveAuthenticationDetails(Request $request){
        // echo $public_key;
        // Generating a salt to be added to the private key:
        $salt_private_key = Str::password(16);
        $private_key = $request->private_key;
        $salt_and_private_key = $salt_private_key . $private_key;
        $hash = Hash::make($salt_and_private_key);
        // echo $hash;
        // To add a new row in the `secrets` table:
        $secret = new secret();
        $secret->public_key = $request->public_key;
        $secret->salt_private_key = $salt_private_key;
        $secret->private_key = $hash;
        $secret->save();
        // return $hash;
        return response()->json(['success' => true]);
    }

    public function processData(Request $request){
        return $this->authenticateRequest2($request);
    }

    //Try1: Compare the hashes:
    private function authenticateRequest1(Request $request){
        $secret = secret::where('public_key', $request->public_key)->first();
        $salt_private_key = $secret->salt_private_key;
        $salt_and_private_key = $salt_private_key . $request->private_key;
        $hash = Hash::make($salt_and_private_key);
        echo $hash;
        $isAuthentic = $secret->private_key == $hash;
        if($isAuthentic){
            return response()->json(['authentication' => 'successful']);
        } else{
            return ' Bad request';
        }
    }

    //Try2: use Laravel's `Hash::check` method:
    private function authenticateRequest2(Request $request){
        $secret = secret::where('public_key', $request->public_key)->first();
        $salt_private_key = $secret->salt_private_key;
        $salt_and_private_key = $salt_private_key . $request->private_key;
        $isAuthentic = Hash::check($salt_and_private_key, $secret->private_key);
        if($isAuthentic){
            return response()->json(['authentication' => 'successful']);
        } else{
            return ' Bad request';
        }
    }

}

