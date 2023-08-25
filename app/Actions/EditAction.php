<?php

namespace App\Actions;

use TCG\Voyager\Actions\EditAction as VoyagerEditAction;

class EditAction extends VoyagerEditAction
{
    public function getTitle()
    {
        return 'Sửa';
    }
}