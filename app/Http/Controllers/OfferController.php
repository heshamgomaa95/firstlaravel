<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use OfferTrait;
    public function create(){
        //view form to add this offer
        return view('ajaxoffer.create');
    }

    public  function store(OfferRequest $request){
        //save offer into database using AJAX
        $path_file='images/offers';
        $file_name= $this->saveImage($request->photo, $path_file);
       //insert into table
        $offer=Offer::create([
              'name'=>$request->name,
              'price'=>$request->price,
              'details'=>$request->details,
              'photo'=>$file_name
        ]);
         // return 'save successfuly';
        if($offer)
        {
            return response()->json([
             'status'=>true,
             'msg'=>'تم الاضافه بنجاح',
             ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'فشل التسجل',
                ]);
        }


    }
    public function getall(){
        $offers=Offer::select('id','name','price','details')->get();
        return view('ajaxoffer.all',compact('offers'));
    }

    public function delete(Request $request){
        $offer=Offer::find($request->id);
        if(!$offer){
            return response()->json([
                'status'=>false,
                'msg'=>'لم يتم تنفيذ المطلوب'
            ]);
        }else{
            $offer->delete();
            return response()->json([
                'status'=>true,
                'msg'=>'تم  تنفيذ المطلوب بنجاح',
                'data_remove'=>$request->id
            ]);
        }
    }


    public function edit(Request $request)
    {

        $offer=Offer::find($request->offer_id);
        if($offer)
        {
            $offer=Offer::select('id','name','price','details')->find($request->offer_id);
            return view('ajaxoffer.edit',compact('offer'));
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'فشل البحث',
                ]);
        }
    }


    public function update(Request $request)
    {

        $offer=Offer::find($request->offer_id);
        if($offer)
        {
           // $offer->update($request->all());
           $offer-> update([
            'name'=>$request->name,
            'price'=>$request->price,
            'details'=>$request->details]);
            return response()->json([
                'status'=>true,
                'msg'=>'تم التعديل بنجاح',
                ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'فشل التعديل',
                ]);
        }
    }




}
