<?php

namespace App\Actions;

use TCG\Voyager\Actions\EditAction as VoyagerEditAction;

class EditAction extends VoyagerEditAction
{
    public function getTitle()
    {
        return '';
    }
    public function getIcon()
    {
        return '';
    }
    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success pull-right edit',
            'data-icon' => '&#xe010;',
        ];
    }
    public function shouldActionDisplayOnRow($row)
    {   
        return $row->deleted_at == '';
    }
}