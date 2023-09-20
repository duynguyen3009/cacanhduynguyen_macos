<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CategoryController extends AdminController
{
    protected $categoryRepository;
    protected $fieldsAcceptSearch   = [
        ''              => 'Chọn trường tìm kiếm', 
        'id'            => 'ID', 
        'name'          => 'Tên', 
    ];
    protected $fieldsAcceptSorting = [ // show select để orderBy
        ''              => 'Sắp xếp giảm dần',
        'id'            => 'Id', 
        'name'          => 'Tên', 
        'sequence'      => 'Vị trí',
    ];


    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $request                        = $request->all();
        $dataLoadSearch                 = [];
        $dataLoadSearch['sort']         = $this->fieldsAcceptSorting;
        $dataLoadSearch['key_search']   = $this->fieldsAcceptSearch;
        $dataLoadSearch['active']       = $this->categoryRepository->countStatus(1);
        $dataLoadSearch['inactive']     = $this->categoryRepository->countStatus(0);

        $records = $this->categoryRepository->list($request);

        return view('admin.category.index', compact('dataLoadSearch', 'records'));
    }

    public function form(Request $request, $id = null)
    {
        $request = $request->all();
        $record = null;
        if (!empty($id)) {
            $record = $this->categoryRepository->getRecord($id)->first();
        }

        $listDropDown = $this->categoryRepository->getListDropdown();
        $listDropDown->prepend('Danh mục cha', '0');        
        return view('admin.category.form', compact('request', 'record', 'listDropDown'));
    }

    public function save(CategoryRequest $request)
    {
        $formFields             = $request->all();
        $transformSearch        = json_decode($formFields['transform_search'], true);
        $formFields['status']   = !isset($formFields['status']) ? 0 : 1;
        
        $formFieldsAccept       = Arr::only($formFields, ['id', 'name' ,'status', 'sequence', 'parent']);
        //case edit
        if (isset($formFields['id'])) {
            $id = $this->categoryRepository->updateRecord($formFieldsAccept);
            session()->flash('action_success', __('messages.update_success', ['attribute' => $formFieldsAccept['name']]));
            
        } else {
            $this->categoryRepository->insert($formFieldsAccept);
            session()->flash('action_success', __('messages.insert_success', ['attribute' => $formFieldsAccept['name']]));
        }
        
        return response()->json([
            'success'   => true,
            'url'       => route('admin.category.index', $transformSearch),
        ]);
    }

    public function deleteData(Request $request)
    {
        $request    = $request->all();
        $id         = $request['id'];

        $record = $this->categoryRepository->getRecord($id)->first();

        if (empty($record)) {
            logger("Category table is not exist record of id: " . $id);
            return response()->json([
                'success'   => false,
                'msg'       => __('messages.delete_recored_fail', ['id' => $id]),
            ]);
        }
        
        $this->categoryRepository->deleteData($id);

        return response()->json([
            'success' => true,
            'msg' => __('messages.delete_recored_success', ['id' => $id]),
        ]);
    }
}
