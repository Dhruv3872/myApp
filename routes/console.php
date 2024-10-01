<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\secret;

/* Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly(); */

/* //The first part: storing values in the database:
Schedule::call(function (){
    // Generating a public key for the sake of the demo:
    $public_key = Str::random(20);
    echo 'public key: ';
    var_dump($public_key);
    // Generating a salt for the sake of the demo:
    $salt_private_key = Str::password(16);
    // echo 'salt: ' . $salt_private_key . '\n';
    // Generating a private key for the sake of the demo:
    $private_key = Str::password();
    echo 'private key: ';
    var_dump($private_key);
    // Salt concatenated with the private key:
    $salt_and_private_key = $salt_private_key . $private_key;
    $hash = Hash::make($salt_and_private_key);
    // To add a new row in the `secrets` table:
    $secret = new secret();
    $secret->public_key = $public_key;
    $secret->salt_private_key = $salt_private_key;
    $secret->private_key = $hash;
    $secret->save();
})->everyMinute(); */

// The second part: Retrieving and comparing the private key: