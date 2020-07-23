<?php

namespace App\Listeners;

use App\Events\VedioViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VedioViewer $event)
    {
        if(!session()->has('VideoIsVisited')){
            $this -> updateViewer($event->video);
        }else{
            return false;
        }
    }


    public function updateViewer($video){
        $video->view=$video->view+1;
       $video->save();

        session()->put('VideoIsVisited', $video->id);
    }
}

