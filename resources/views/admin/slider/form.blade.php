@php
    $blade = [
        'inputs' => require(app_path('Helpers/Form/config/slider.php')),
    ];
    $path = isset($record->image) ? 'storage/sliders/' . @$record->image : null;
@endphp
@extends('admin.layouts.master')
@section('main')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="d-flex">
            <a class="btn btn-secondary transform-search" href="javascript:void(0)" data-href="{{ route('admin.slider.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reply" viewBox="0 0 16 16">
                    <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z"/>
                </svg>
            </a>
            <div class="app-page-title" style="margin: 0px 30px">Quản Lý / Slider / Thêm mới</div>
        </div>
        <hr class="mb-4">

        @include('components.form_search_tmp', ['request' => $request])

        <form action="{{ route('admin.slider.save') }}" method="POST" enctype="multipart/form-data" id="sliderForm">
            @csrf
            @if (isset($record->id))
                <input type="hidden" name="id" value="{{ $record->id }}">
            @endif
            <div class="row g-4 settings-section" style="background-color: #dcdde1">
                <div class="col-12 col-md-4">
                    <div style="display: flex">
                        <svg width="23" height="23" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                        </svg>&nbsp;&nbsp;
                        <h3 class="section-title">Hình ảnh</h3>
    
                        <span class="ms-2 text-danger">*</span>
                    </div>
                    <hr class="mb-4">
                    <div class="section-intro">Vui lòng chọn hình ảnh có đuôi mở rộng là jpg, png.
                         <input type="file" name="image" id="preview" class="form-control-file" accept="image/*" onchange="previewImage()">
                         @if (isset($record->image))
                            <input type="hidden" name="old_image" value="{{ $record->image }}">
                         @endif
                    </div>
                    <div class="text-danger error" name="image"></div>
                    <div id="preview-image" class="mt-2">
                        <img src="{{ asset($path) }}" alt="" style="max-width: 100%;">
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            @foreach ($blade['inputs'] as $col => $value)
                                @switch($value['type'])
                                    @case('input')
                                        <div class="mb-3">
                                            <label class="form-label">{{ $value['label'] }}</label>
                                            @if ($value['required'])
                                                <span class="ms-2 text-danger">*</span>
                                            @endif
                                            <input type="text" class="form-control " name="{{ $col }}" id="" value="{{ isset($record->$col) ? $record->$col : null }}" >
                                            <div class="error" name="{{ $col }}"></div>
                                        </div>
                                    @break

                                    @case('datepicker')
                                        <div class="mb-3">
                                            <label class="form-label">{{ $value['label'] }}</label>
                                            @if ($value['required'])
                                                <span class="ms-2 text-danger">*</span>
                                            @endif
                                            <input type="text" class="form-control datepicker" name="{{ $col }}" id="" value="{{ isset($record->$col) ? $record->$col : null }}">
                                            <div class="error" name="{{ $col }}"></div>
                                        </div>
                                    @break

                                    @case('textarea')
                                        <div class="mb-3">
                                            <label class="form-label">{{ $value['label'] }}</label>
                                            @if ($value['required'])
                                                <span class="ms-2 text-danger">*</span>
                                            @endif
                                            <textarea class="form-control" id="" name="{{ $col }}" rows="5 ">{{ isset($record->$col) ? $record->$col : null }}</textarea>
                                        </div>
                                    @break

                                    @case('checkbox')
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ $value['label'] }}</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="{{ $col }}" {{ (isset($record->$col) && $record->$col == 1) ? 'checked' : null }}>
                                            </div>  
                                        </div>
                                    @break
                                        
                                @endswitch
                            @endforeach
                            <button type="submit" class="btn app-btn-primary">Lưu thay đổi</button>
                        </div>
                    <!--//app-card-->
                </div>
            </div>

        </form>
    </div>
</div>

@push('css')
  <style>
 
  </style>
@endpush
@push('js')
  <script>
    // FORM
    $('form#sliderForm').on('submit', function(e){
        e.preventDefault();
        var form = this;
        var idForm = 'form#sliderForm';
        $.ajax({
            url     : $(form).attr('action'),
            method  : 'POST',
            data    : new FormData(form),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(form).find('div.error').text('');
                $(form).find('input.is-invalid').removeClass("is-invalid");
            },
            success:function(res){
                if (res.success) {
                    $('form#searchForm').attr('action', res.url).submit();
                }
            },
            error: function(jqXHR, status, error) {
                switch (jqXHR.status) {
                    case 422:
                        $.each(jqXHR.responseJSON.errors, function (col, msg){
                            $(idForm + ' input[name=' + col + ']').addClass("is-invalid");
                            $(idForm + ' div[name=' + col + ']').addClass("text-danger");
                            $(idForm + ' div[name=' + col + ']').append(msg);
                        });
                    break;
                
                    default:
                        alert('SERVER ERROR');
                        return;
                    break;
                }
                
            }
        });
    });
  </script>
@endpush
@endsection 
 
 