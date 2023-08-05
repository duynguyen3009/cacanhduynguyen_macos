<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function updateStatus(Request $request)
    {
        $request            = $request->all();
        $nameRepository     = (\Request::segment(2)) . 'Repository';
        $request['status']  = $request['status'] == 'true' ? 1 : 0;

        $this->$nameRepository->updateStatus(Arr::only($request, ['id', 'status']));

        return response()->json([
            'success' => true,
            'msg'     => __('messages.update_success', ['attribute' => 'Trạng thái']),
        ]);
    }

    public function updateSequence(Request $request)
    {
        $request        = $request->all();
        $nameRepository = (\Request::segment(2)) . 'Repository';

        $this->$nameRepository->updateSequence(Arr::only($request, ['id', 'sequence']));

        return response()->json([
            'success' => true,
            'msg'     => __('messages.update_success', ['attribute' => 'Vị trí']),
        ]);
    }
}
