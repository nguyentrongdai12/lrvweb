<?php

namespace App\Actions;

use TCG\Voyager\Actions\RestoreAction as VoyagerRestoreAction;

class RestoreAction extends VoyagerRestoreAction
{
    public function getTitle()
    {
        //return __('voyager::generic.restore');
        return '';
    }
    public function getIcon()
    {
        return 'voyager-wand';
    }
    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right restore',
        ];
    }
}
