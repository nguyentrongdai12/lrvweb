<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;


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
        return 'read';
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
    public function getDefaultRoute()
    {
        //return route('voyager.'.$this->dataType->slug.'.remove', $this->data->{$this->data->getKeyName()});
        //echo 'voyager.'.$this->dataType->slug.'.remove', $this->data->{$this->data->getKeyName()};
        //return route('voyager.'.$this->dataType->slug.'.edit', $this->data->{$this->data->getKeyName()});
        return route('voyager.'.$this->dataType->slug.'.destroy', $this->data->{$this->data->getKeyName()});
        //$('#delete_form')[0].action = '{{ route('voyager.'.$dataType->slug.'.destroy', '__id') }}'.replace('__id', $(this).data('id'));
    }
    public function shouldActionDisplayOnRow($row)
    {   
        return $row->deleted_at != '';
    }
}