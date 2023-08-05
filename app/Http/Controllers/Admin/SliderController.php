<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\SliderRepository;
use App\Http\Requests\Admin\SliderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SliderController extends AdminController
{
    protected $sliderRepository;
    protected $fieldsAcceptSearch   = [
        ''              => 'Chọn trường tìm kiếm', 
        'id'            => 'ID', 
        'name'          => 'Tên', 
        'url'           => 'Đường dẫn', 
        'description'   => 'Miêu tả'
    ];
    protected $fieldsAcceptSorting = [ // show select để orderBy
        ''              => 'Sắp xếp giảm dần',
        'id'            => 'Id', 
        'name'          => 'Tên', 
        'url'           => 'Đường dẫn', 
        'description'   => 'Miêu tả',
        'sequence'      => 'Vị trí',
    ];

    protected $storagePath = 'public'. DIRECTORY_SEPARATOR. 'sliders' . DIRECTORY_SEPARATOR ;
    protected $defaultImg  = 'default.jpg';

    public function __construct(
        SliderRepository $sliderRepository
    ) {
        $this->sliderRepository = $sliderRepository;
    }

    public function index(Request $request)
    {
        $request                            = $request->all();
        $request['fieldsAcceptSearch']      = $this->fieldsAcceptSearch;
        $request['fieldsAcceptSorting']     = $this->fieldsAcceptSorting;

        $records = $this->sliderRepository->list($request);

        
        $cntStatusActive    = $this->sliderRepository->countStatus(1);
        $cntStatusInactive  = $this->sliderRepository->countStatus(0);

        $breadcrumb = ['Quản Lý', 'Slider'];
        
        return view('admin.slider.index', compact('breadcrumb', 'request', 'records', 'cntStatusActive', 'cntStatusInactive'));
    }

    public function form(Request $request)
    {
        $request = $request->all();
        $record = null;
        if (!empty($request['id'])) {
            $record = $this->sliderRepository->getRecord($request['id'])->first();
        }

        return view('admin.slider.form', compact('request', 'record'));
    }

    public function save(SliderRequest $request)
    {
        $formFields             = $request->all();
        $file                   = $request->file('image');
        $fileName               = null;
        $formFields['status']   = !isset($formFields['status']) ? 0 : 1;

        if (!empty($file)) {
            $fileName               = date("YmdHms") . '.' .$file->extension();
            $formFields['image']    = $fileName;
        } 
        
        $formFieldsAccept       = Arr::only($formFields, ['id', 'image', 'name', 'url', 'description' ,'status', 'sequence', 'start_date', 'end_date']);

        //case edit
        if (isset($formFields['id'])) {
            if (isset($formFieldsAccept['image'])) { // chọn ảnh mới
                $imageName      = $formFields['old_image'];
                $pathImageName  = storage_path('app' . DIRECTORY_SEPARATOR . $this->storagePath . $imageName);
                if (!empty($imageName)) {
                    if (file_exists($pathImageName)) {
                        unlink($pathImageName);
                    } 
                } 
                $file->storeAs($this->storagePath, $fileName); 

            } else { // không chọn ảnh mới
                $formFieldsAccept['image'] = $formFields['old_image'];
            }
            $id = $this->sliderRepository->updateRecord($formFieldsAccept);
            session()->flash('action_success', __('messages.update_success', ['attribute' => $id]));
            
        } else {
            $file->storeAs($this->storagePath, $fileName); 
            $this->sliderRepository->insert($formFieldsAccept);
            session()->flash('action_success', __('messages.insert_success', ['attribute' => $formFieldsAccept['name']]));
        }

        return response()->json([
            'success'   => true,
            'url'       => route('admin.slider.index'),
        ]);
    }

    public function deleteData(Request $request)
    {
        $request    = $request->all();
        $id         = $request['id'];

        $record = $this->sliderRepository->getRecord($id)->first();

        if (empty($record)) {
            logger("Slider table is not exist record of id: " . $id);
            return response()->json([
                'success'   => false,
                'msg'       => __('messages.delete_recored_fail', ['id' => $id]),
            ]);
        }

        $imageName      = $record->image;
        $pathImageName  = storage_path('app' . DIRECTORY_SEPARATOR .$this->storagePath . $imageName);
        if (!empty($imageName)) {
            if (file_exists($pathImageName)) {
                unlink($pathImageName);
            } 
        } 
        
        $this->sliderRepository->deleteData($id);

        return response()->json([
            'success' => true,
            'msg' => __('messages.delete_recored_success', ['id' => $id]),
        ]);
    }
}
