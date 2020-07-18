<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
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

    public function editoffer($offer_id)
    {
       // Offer::findOrFail($offer_id);
       $offer=Offer::find($offer_id);
       if(!$offer){
           return redirect()->back();
       }else
       {
        $offer=Offer::select('id','name','price','details')->find($offer_id);
        return view('offers.edit',compact('offer'));}
    }


    public function updateoffer(OfferRequest $request,$offer_id){
        //validation request
        // update

        $offer=Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }else
        {
            /* $offer->update([
                'name'=>$request->name,
                'price'=>$request->price
            ]); */
            $offer->update($request->all());
            return redirect()->back()->with(['success'=>'تم التحديث ينجاح']);
        }
    }



    public function getoffers(){
       return Offer::get();
    // return Offer::select('id','name')->get();
    }


    public function show_form(){
        return view('offers.create');
    }
 //   'name','price','details','created_at','updated_at'
    public function getAllOffers(){
        $offers=Offer::select('id','name','price','details')->get();

        return view('offers.all',compact('offers'));
    }

    public function store(OfferRequest $request){

      //  $rules_validaation=$this->get_rules_validaation();
      //  $message=$this->get_message();
            // this array take

      //  $validator=Validator::make($request->all(),$rules_validaation,$message);

       // if($validator->fails()){
      //  return redirect()->back()->withErrors($validator)->withInput($request->all());
      //   }


      // save photo in folder

      $path_file='images/offers';
      $file_name= $this->saveImage($request->photo, $path_file);

        Offer::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'details'=>$request->details,
            'photo'=>$file_name
            ]);

       // return 'save successfuly';
       return redirect()->back()->with(['success'=>'تم الاضافه بنجاح']);

    }

    protected function saveImage($photo,$folder){
        $file_extension = $photo->photo->getClientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $path=$folder;
        $photo->photo->move($path,$file_name);
        return $file_name;
    }
   /* protected function get_rules_validaation(){
        return $rules_validaation=[
            'name'=>'required|max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required'];
    }

    protected function get_message (){
        return $message=[
            'name.required'=>__('messages.messages_name'),
            'name.unique'=>__('messages.messages_unique'),
            'price.numeric'=>__('messages.messages_pricenumeric'),
            'price.required'=>__('messages.messages_pricerequired')
        ];

    }
    */






}
