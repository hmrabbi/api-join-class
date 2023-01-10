<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Validator;

class DoctorController extends Controller
{
    public function createDoctor(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'doctor_name' => 'required',
            'doctor_email' => 'required|email',
            'doctor_address' => 'required',
            'hospital_name' => 'required',
       ]);
       if($validator->fails()){
        return response()->json([
            'status' => false,
            'message' => 'Data Not Found',
            'errors' => $validator->errors()
        ]);
       }

       $inputall = $request->all();
       $doctor = Doctor::create($inputall);

       return response()->json([
        'status' => 'true',
        'message' => 'Doctor Create Successfully!',
        'data' => $doctor
       ]);

    }
}
