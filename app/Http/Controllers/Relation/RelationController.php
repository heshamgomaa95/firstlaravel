<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    //

    public  function hasOneRelation(){
        $user=User::with(['phone'=>function($q){
            $q->select('code','phone','user_id');
        }])->find(4);

      //  $user=User::with('phone')->find(4);
        return response()->json($user);
    }

    public  function GetUserHasPhone(){
        $user=User::whereHas('phone',function ($q){
            $q->where('code','+02');
        })->get();
        return $user;
    }

    public  function GetUserNotHasPhone(){
        $user=User::whereDoesntHave('phone')->get();
        return $user;
    }

    public  function  GetHospitalDoctors(){
        $hospital=Hospital::with('doctors')->find('1');
        $hospital->doctors->makeHidden(['hostpital_id']);
        return $hospital;
    }
    public function hospitals()
    {

        $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('doctors.hospitals', compact('hospitals'));
    }

    public function doctors($hospital_id)
    {

        $hospital = Hospital::find($hospital_id);
       $doctors = $hospital->doctors;
       return view('doctors.doctors', compact('doctors'));
    }

    public  function hospialHasDoctor(){
        return Hospital::whereHas('doctors')->get();
    }

    public function hospialHasOnlyMale(){
       return Hospital::with('doctors')->whereHas('doctors',function($q){
            $q->where('gender','1');
        })->get();
    }

    public function hospialdosentDoctor(){
        return Hospital::whereDoesntHave('doctors')->get();
    }

    public function deleteHospital($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        if (!$hospital)
            return abort('404');
        //delete doctors in this hospital
        $hospital->doctors()->delete();
        $hospital->delete();

        return redirect() -> route('hospital_all');
    }

    public  function  getDoctorServices(){
        return Doctor::with('services')->find(3);
     //   return $doctor->services;
    }

    public function getServicesDoctors(){
        return Service::with(['doctors'=>function($q){
            $q->select('name','title');
        }])->find('1');
    }

    public function getDoctorServicesById($doctorId){
        $doctor=Doctor::find($doctorId);
        $services=$doctor->services; ///doctor_service_by_id
        $doctors=Doctor::select('id','name')->get(); ///all_doctor
        $allServices=Service::select('id','name')->get(); // all_services
        return view('doctors.services',compact('services','doctors','allServices'));
    }

    public  function SaveServiceToDoctor(Request $request){
       $doctor=Doctor::find($request->doctor_id);
       if(!$doctor){
           return abort('404');
       }else{
          // $doctor->services()->attach($request->servicesIds);
            //$doctor->services()->sync($request->servicesIds);
           $doctor->services()->syncWithoutDetaching($request->servicesIds);

           return 'success';
       }
    }

    public function getPatientDoctor(){
      $patient=Patient::find('2');
     return $patient->doctor;
    }

    public function getDoctorCountry(){
       return $country=Country::with('doctors')->find(1);
        return $country->doctors;
    }

    public function getDoctors(){
       return Doctor::select('id','name','gender')->get();

    }
}
