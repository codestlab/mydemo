<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Mail\UserBrandRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;

class UserController extends Controller
{
    public function store(StoreUserRequest $request){
        $response = [];
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->brand_name = $request->brandName;

            $data = $request->except(['brandCrFile', 'uploadCr']);
            $user->user_detail = generatePDF($data);

            if ( $request->hasFile('brandCrFile') ) {
                $user->cr_file = uploadFile($request->brandCrFile);
            }

            $user->save();
            $response = ['statusCode' => 200, 'message' => "User saved successfully"];
        } catch (\Exception $e){
            $response = ['statusCode' => 400, 'message' => "Something went wrong", 'error' => $e];
        } finally {
            return $response;
        }
    }
}
