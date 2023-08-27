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
        return 'Xóa';
    }
    public function getIcon()
    {
        return 'voyager-trash';
    }

    public function getPolicy()
    {
        return 'browse';
    }
    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
            'style' => 'margin-right:5px;',
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
        //return route('voyager.'.$this->dataType->slug.'.Deleteforever', $this->data->{$this->data->getKeyName()});
        //echo 'voyager.'.$this->dataType->slug.'.remove', $this->data->{$this->data->getKeyName()};
        //return route('voyager.'.$this->dataType->slug.'.forceDelete', $this->data->{$this->data->getKeyName()});
        //return route('voyager.'.$this->dataType->slug.'.destroy', $this->data->{$this->data->getKeyName()});
        //$('#delete_form')[0].action = '{{ route('voyager.'.$dataType->slug.'.destroy', '__id') }}'.replace('__id', $(this).data('id'));
        //$model = \App\Models\Danhmucchi::find(5);
        //$model->forceDelete();
       // return "";
       
       //$slug = $request->input('type_slug');
       //$dataType = Voyager::model('DataType')->where('slug', '=', $slug)->firstOrFail();
       //return route('deleteforever/'.$this->dataType->slug.'/'.$this->data->{$this->data->getKeyName()});
       return route('deleteforever', ['table' => $this->dataType->slug, 'keyvalue' => $this->data->{$this->data->getKeyName()}] );
       //<a href="{{ route('deleteforever', ['table' => $dataType->slug, 'keyvalue' => $data->getKey()]) }}"> Xóa vĩnh viễn</a> 
       //return route('deleteforever/{table}/{keyvalue}', 'Cdbcontroller@deleteforever')->where(['table' => $this->dataType->slug, 'keyvalue' => $this->data->{$this->data->getKeyName()}]);
        //return route('test', 'Cdbcontroller@test');
    }
    public function shouldActionDisplayOnRow($row)
    {   
        return $row->deleted_at != '';
    }
}