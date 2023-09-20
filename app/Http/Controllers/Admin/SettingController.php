<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\SettingRepository;
use App\Http\Requests\Admin\SettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SettingController extends AdminController
{
    protected $settingRepository;
    protected $storagePath = 'public'. DIRECTORY_SEPARATOR ;

    public function __construct(
        SettingRepository $settingRepository
    ) {
        $this->settingRepository = $settingRepository;
    }

    public function index(Request $request)
    {
        $records = $this->settingRepository->getList();

        if ($records->count() == 0) {
            $mode = 'add';
            $record = null;
        } else {
            $mode = 'edit';
            $record = $records->first();
        }
        
        return view('admin.setting.form', compact('record', 'mode'));
    }

    public function save(SettingRequest $request)
    {
        $formFields             = $request->all();
        $file                   = $request->file('logo');
        $fileName               = null;

        if (!empty($file)) {
            $fileName              = 'logo' . '.' .$file->extension();
            $formFields['logo']    = $fileName;
        } 
        
        $formFieldsAccept       = Arr::only($formFields, ['company_name','phone_number','address','email','consulation_time','link_facebook','link_youtube','link_tiktok','link_googlemap','logo']);

        //case edit
        $records = $this->settingRepository->getList();

        // $record = $records->first();
        // dd($record);
        // if (isset($formFields['id'])) {
        if ($records->count() > 0) {
            $record = $records->first();
            if (isset($formFieldsAccept['logo'])) { // chọn ảnh mới
                $imageName      = $formFields['old_logo'];
                $pathImageName  = storage_path('app' . DIRECTORY_SEPARATOR . $this->storagePath . $imageName);
                if (!empty($imageName)) {
                    if (file_exists($pathImageName)) {
                        unlink($pathImageName);
                    } 
                } 
                $file->storeAs($this->storagePath, $fileName); 

            } else { // không chọn ảnh mới
                $formFieldsAccept['logo'] = $formFields['old_logo'];
            }
            // dump($records->first());
            $formFieldsAccept['id'] = $record->id;
            $id = $this->settingRepository->updateRecord($formFieldsAccept);
            session()->flash('action_success', __('messages.update_success', ['attribute' => '']));
            
        } else {
            $file->storeAs($this->storagePath, $fileName); 
            $this->settingRepository->insert($formFieldsAccept);
            // session()->flash('action_success', __('messages.insert_success', ['attribute' => $formFieldsAccept['name']]));
        }

        return response()->json([
            'success'   => true,
            'url'       => route('admin.setting.index'),
        ]);

    }
}
