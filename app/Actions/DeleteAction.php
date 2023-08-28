<?php

namespace App\Actions;

use TCG\Voyager\Actions\DeleteAction as VoyagerDeleteAction;

class DeleteAction extends VoyagerDeleteAction
{
    public function getTitle()
    {
        return '';
    }
    public function getDefaultRoute()
    {
        return 'javascript:;';
    }
}