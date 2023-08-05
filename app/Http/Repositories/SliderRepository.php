<?php 

namespace App\Http\Repositories;
use App\Models\Slider as MainModel;
use App\Helpers\AdminProcess;
use Illuminate\Support\Facades\DB;

class SliderRepository
{
    protected $table = 'sliders';

    public function list($req)
    {
        $searchInputs = isset($req['search']) ? ($req['search']) : null;

        $qb = MainModel::query();

        if (isset($searchInputs['status'])) {
            $qb = $qb->where('status', $searchInputs['status']);
        }

        if (!empty($searchInputs['key_search']) && !empty($searchInputs['value_search'])) {
            $qb = $qb->where($searchInputs['key_search'], 'like', '%'. $searchInputs['value_search'] .'%');
        }

        $sorting = isset($searchInputs['sorting']) ? $searchInputs['sorting'] : 'sequence';
        $qb = $qb->orderBy($sorting, 'desc');
        $qb = $qb->paginate(config('params.per_page'));

        return $qb;
    }

    public function countStatus($value)
    {
        return MainModel::select(DB::raw('count(*) as count_status'))->where('status', $value)->value('count_status');
    }

    public function insert($formFields)
    {
       MainModel::create($formFields);
    }

    public function updateRecord($formFields)
    {
        $record = MainModel::findOrFail($formFields['id']);

        $record->image              = $formFields['image'];
        $record->name               = $formFields['name'];
        $record->url               = $formFields['url'];
        $record->description        = $formFields['description'];
        $record->status             = $formFields['status'];
        $record->sequence           = $formFields['sequence'];
        $record->start_date    = $formFields['start_date'];
        $record->end_date      = $formFields['end_date'];
        
        $record->save();

        return $record->id;
    }

    public function updateStatus($formFields)
    {
        $record = DB::table($this->table)
                    ->where('id', $formFields['id'])
                    ->update([
                        'status' => $formFields['status']
                    ]);

        return $record;
    }

    public function updateSequence($formFields)
    {
        $record = DB::table($this->table)
                    ->where('id', $formFields['id'])
                    ->update([
                        'sequence' => $formFields['sequence']
                    ]);

        return $record;
    }

    public function deleteData($id)
    {
        MainModel::where('id', $id)->delete();
    }

    public function getRecord($id)
    {
        $record = MainModel::where('id', $id);
        return $record;
    }

    public function getRecords($ids)
    {
        $records = MainModel::whereIn('id', $ids);

        return $records;
    }
}