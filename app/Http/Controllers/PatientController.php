<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Validator;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function patientInerJoin(Request $request){
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'patient_name' => 'required',
            'patient_email' => 'required|email',
            'patient_code' => 'required',
            'status' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'errors' => $validator->errors()
            ], 401);
        }

        $allpatient = $request->all();
        $patient = Patient::create($allpatient);

        return response()->json([
            'status' => true,
            'message' => 'Data Save Successfully!',
            'data' => $patient
        ]);
    }

    public function inerJoin(Request $request){
        $getlidt = DB::table('patients')
            ->join('doctors', 'doctors.id', '=', 'patients.doctor_id')
            ->select('patients.*', 'doctors.*')
            ->get();

           

            return response()->json([
                'status' => true,
                'message' => 'Data get Successfully',
                'data' => $getlidt

            ]);
    }

    public function leftJoin(Request $request)
    {
        $leftjoin = DB::table('patients')
            ->leftJoin('doctors', 'doctors.id', '=', 'patients.doctor_id')
            ->get();

            return response()->json([
                'status' => true,
                'message' => 'Data get Successfully',
                'data' => $leftjoin

            ]);    
    }

    public function rightJoin(Request $request)
    {
        $rightjoin = DB::table('patients')
            ->rightJoin('doctors', 'doctors.id', '=', 'patients.doctor_id')
            ->get();

            return response()->json([
                'status' => true,
                'message' => 'Data Get Successfully!',
                'data' => $rightjoin
            ]);
    }
}
