<?php

namespace App\Actions;

use TCG\Voyager\Actions\ViewAction as VoyagerViewAction;

class ViewAction extends VoyagerViewAction
{
    public function getTitle()
    {
        //return __('voyager::generic.view');
        return '';
    }
}
