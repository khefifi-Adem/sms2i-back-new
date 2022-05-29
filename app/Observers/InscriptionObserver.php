<?php

namespace App\Observers;

use App\Models\CycleFormation;
use App\Models\Inscription;

class InscriptionObserver
{

    public function created(Inscription $inscription)
    {
        $decrem = CycleFormation::find($inscription->id_cycle_formation);
        $decrem->nb_places_dispo = $decrem->nb_places_dispo-1;
        if ($decrem->nb_places_dispo === 0) {
            $decrem->etat = 'complet';
        }
        $decrem->save();

    }



    public function updated(Inscription $inscription)
    {
        //
    }


    public function deleted(Inscription $inscription)
    {
        //
    }


    public function restored(Inscription $inscription)
    {
        //
    }


    public function forceDeleted(Inscription $inscription)
    {
        //
    }
}
