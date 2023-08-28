<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Actions\AbstractAction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;


class DeleteForever extends AbstractAction
{
    public function getTitle()
    {
        return '';
    }
    public function getIcon()
    {
        return '';
    }

    public function getPolicy()
    {
        return 'browse';
    }
    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-danger pull-right',
            'style' => 'margin-right:5px;',
            'data-icon' => '&#xe030;',
            //'data-id' => $this->data->{$this->data->getKeyName()},
            //'id'      => 'destroy-'.$this->data->{$this->data->getKeyName()},
        ];
    }
    public function confirm()
    {
        return 'Are you sure you want to permanently delete this item?';
    }
    public function getDefaultRoute()
    {
       return route('deleteforever', ['table' => $this->dataType->slug, 'keyvalue' => $this->data->{$this->data->getKeyName()}] );
    }
    public function shouldActionDisplayOnRow($row)
    {   
        return $row->deleted_at != '';
    }
}