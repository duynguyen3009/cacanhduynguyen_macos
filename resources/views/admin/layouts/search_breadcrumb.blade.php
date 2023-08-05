@php
    $classActive    = null;
    $classInactive  = null;

    if (!empty($request) && @$request['search']['status'] == 1) {
        $classActive = 'btn-success';
    }
    if (!empty($request) && @$request['search']['status'] == '0') {
        $classInactive = 'btn-success';
    }
    $routeAdd = 'admin.' . \Request::segment(2) . '.form';
@endphp
<form action="{{ url()->current() }}" method="POST" id="searchForm" >
    @csrf
    <input type="hidden" name="search[status]" value="{{ @$request['search']['status'] }}">
    <input type="hidden" name="page" value="{{ @$request['page'] }}">
    <input type="hidden" name="id" value="">
    <div class="area-search">
        <div class="row justify-content-between">
            <div class="col-auto app-page-title">
                @foreach ($breadcrumb as $item)
                    {{ $item }} 
                    @if(!$loop->last)
                        / 
                    @endif
                @endforeach
            </div>
        
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <div class="docs-search-form row gx-1 align-items-center">
                                <div class="col-auto">
                                    @include('components.select', [
                                                'class'     => 'form-select w-auto',
                                                'name'      => 'search[sorting]',
                                                'items'     => @$request['fieldsAcceptSorting'],
                                                'selected'  => @$request['search']['sorting']
                                            ])
                                </div>
                                <div class="col-auto">
                                    @include('components.select', [
                                        'class'     => 'form-select w-auto',
                                        'name'      => 'search[key_search]',
                                        'items'     => @$request['fieldsAcceptSearch'],
                                        'selected'  => @$request['search']['key_search']
                                    ])
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="" name="search[value_search]" 
                                            value="{{ @$request['search']['value_search'] }}" 
                                            class="form-control" 
                                            placeholder="Tìm kiếm">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn app-btn-secondary">Tìm</button>
                                </div>
                            </div>
                        </div>
                        <!--//col-->
                    
                       
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
        </div>

        <div class="search-status d-flex justify-content-between">
            <div class="status-area">
                <span class="btn btn-secondary {{ $classActive }}" onclick="searchFromStatus(this)" data-value=1>
                    <svg width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-white" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg> <span class="text-white">Active</span>
                    <span class="badge badge-light">{{ $cntStatusActive ?? 0}}</span>
                </span>
                <span class="btn btn-secondary {{ $classInactive }}" onclick="searchFromStatus(this)" data-value=0>
                    <svg width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-white" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg> <span class="text-white">Inactive</span>
                    <span class="badge badge-light">{{ $cntStatusInactive ?? 0}}</span>
                </span>
            </div>

            <div class="add-area">
                <a class="btn btn-info transform-search" style="color: #ffffff" href="javascript:void(0)" data-href="{{ route($routeAdd) }}">
                    <svg width="16" height="16" fill="currentColor" class="bi bi-align-middle" viewBox="0 0 16 16">
                        <path d="M6 13a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v10zM1 8a.5.5 0 0 0 .5.5H6v-1H1.5A.5.5 0 0 0 1 8zm14 0a.5.5 0 0 1-.5.5H10v-1h4.5a.5.5 0 0 1 .5.5z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</form>

<style>
    .area-search {
        background-color: #dcdde1;
        padding: 20px;
        margin: 5px auto 20px auto;
    }

    .active-search {
        width: 5rem;
        border: 1px solid #ccbb97;
        padding: 3px;
        background-color: #e0e6f1;
    }

</style>    