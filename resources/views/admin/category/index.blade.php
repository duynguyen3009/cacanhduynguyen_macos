@extends('admin.layout.master')
@section('main')
<div class="col-lg-11 grid-margin stretch-card">
    <div class="card main-background">
      <div class="card-body">
        <h4 class="card-title">FILTER</h4>
        @include('admin.layout.search', ['dataLoadSearch' => $dataLoadSearch])
        <div class="d-flex justify-content-between">
          <h4 class="card-title">Category</h4>
          <a data-href="{{ route('admin.category.form') }}" class="btn btn-info btn-md transform-search">
            <i class="ti-plus"></i>
          </a>
        </div>
        <br>
        @include('components.alert')
        <div class="table-responsive">
          <hr>
          @if ($records->count() > 0)
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tên</th>
                  <th>Là danh mục cha</th>
                  <th>Là danh mục con của</th>
                  <th>Trạng thái</th>
                  <th>Vị trí</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($records as $i => $record)
                @php
                    $id           = $record->id;
                    $name         = $record->name;
                    $status       = $record->status;
                    $sequence     = $record->sequence;
                    $parent       = $record->parent;
                    $params       = request()->query();
                    $params['id'] = $id;
                @endphp
                <tr>
                    <th scope="row">{{ $i + 1}}</th>
                    <td>{{ $name }}</td>
                    <td><strong>{{ $parent == 'YES' ? $parent : null}}</strong></td>
                    <td>{{ $parent != 'YES' ? $parent : null }}</td>
                   
                    <td style="position: relative">
                        <div class="form-check form-switch"style="margin-left: 30px" >
                            <input class="form-check-input" 
                            data-id="{{ $id }}"
                            data-href="{{ route("admin.category.updateStatus") }}"
                            onchange="updateStatus(this)" 
                            type="checkbox" 
                            name="status" 
                             style="width: 40px; height: 20px;"
                            {{ $status == 1 ? 'checked' : null; }}>
                        </div>  
                    </td>
                    <td style="position: relative">
                        <input type="number" 
                        class="form-control"
                        name="sequence" 
                        data-id="{{ $id }}"
                        data-href="{{ route("admin.category.updateSequence") }}"
                        onchange="updateSequence(this)" 
                        value="{{ $sequence }}" 
                        style="width: 80px">
                        
                    </td>
                    <td>
                        <button type="button" 
                        class="btn btn-outline-primary"
                        data-href="{{ route('admin.category.form', $params) }}"
                        onclick="redirectForm(this, 'edit')"
                        >
                            <svg width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                            </svg>
                        </button>
                        <button type="button" 
                                class="btn btn-outline-danger"
                                data-id="{{ $id }}"
                                data-name="{{ $name }}"
                                data-href="{{ route("admin.category.deleteData") }}"
                                onclick="deleteData(this)" 
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
          @endforeach
              </tbody>
            </table>
            {{ $records->links('admin.layout.pagination') }}
          @else
            <div class="row g-4">
                <div class="col-6 col-md-4 col-xl-3 col-xxl-2 btn btn-danger" style="width: 100%">
                    Không có dữ liệu phù hợp.
                </div>

            </div>
        @endif
        </div>
      </div>
    </div>
  </div>
  @endsection