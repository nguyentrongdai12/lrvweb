<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;

class VoyagerBaseController extends BaseVoyagerBaseController
{
    //    
    public function Deleteforever(Model $model)
    {
        // Delete the model permanently.
        $model->forceDelete();

        // Redirect to the index page.
        return redirect()->route('voyager.' . $model->getTable() . '.index');
    }
}
