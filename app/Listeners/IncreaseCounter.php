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
        $this -> updateViewer($event->video);
    }

    public function updateViewer($video){
        $video->view=$video->view+1;
        $video->save();
    }
}

