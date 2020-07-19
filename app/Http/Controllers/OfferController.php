<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function create(){
        //view form to add this offer
        return view('ajaxoffer.create');
    }

    public  function store(){
        //save offer into database using AJAX
    }
}
