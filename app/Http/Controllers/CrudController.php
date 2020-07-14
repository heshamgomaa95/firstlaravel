<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function getoffers(){
       return Offer::get();
    // return Offer::select('id','name')->get();
    }


    public function show_form(){
        return view('offers.create');
    }


    public function store(Request $request){

        $rules_validaation=[
            'name'=>'required|max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required'];

            $message=[
                'name.required'=>trans('messagesname'),
                'name.unique'=>trans('messages.unique'),
                'price.numeric'=>trans('messagesprice.numeric'),
                'price.required'=>trans('messagesprice.required')
            ];


            // this array take
       $validator=Validator::make($request->all(),
                                $rules_validaation,
                                $message);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }


            Offer::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'details'=>$request->details
            ]);
       // return 'save successfuly';
       return redirect()->back()->with(['success'=>'تم الاضافه بنجاح']);


    }

}
