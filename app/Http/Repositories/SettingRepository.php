<?php 

namespace App\Http\Repositories;
use App\Models\Setting as MainModel;
use App\Helpers\AdminProcess;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SettingRepository
{
    protected $table = 'setting';

    public function getList()
    {
        $qb = MainModel::all();

        return $qb;
    }

    public function insert($formFields)
    {
       MainModel::create($formFields);
    }

    public function updateRecord($formFields)
    {
        MainModel::where('id', $formFields['id'])
                ->update(Arr::except($formFields, ['id']));
        // $record = MainModel::findOrFail($formFields['id']);

        // $record->image              = $formFields['image'];
        // $record->name               = $formFields['name'];
        // $record->url               = $formFields['url'];
        // $record->description        = $formFields['description'];
        // $record->status             = $formFields['status'];
        // $record->sequence           = $formFields['sequence'];
        // $record->start_date    = $formFields['start_date'];
        // $record->end_date      = $formFields['end_date'];
        
        // $record->save();

        // return $record->id;
    }

    public function getRecord($id)
    {
        $record = MainModel::where('id', $id);
        return $record;
    }

}