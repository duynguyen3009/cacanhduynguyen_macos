@php
    $blade = [
        'inputs' => require(app_path('Helpers/Form/config/setting.php')),
    ];
    $path = 'assets/images/default.jpeg';
    $title = 'FORM ADD setting';
    if (isset($record->id) && isset($record->logo)) {
      $path =  'storage/' . @$record->logo;
      $title = 'FORM EDIT setting';
    }
@endphp
@extends('admin.layout.master')

@section('main')
    <div class="content-wrappermain-background">
      @include('components.alert')
      <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card  main-background">
            <div class="card-body">
              <div class="d-flex">
                <a href="{{ route('admin.setting.index', request()->all()) }}" style="text-decoration: none;">
                  <i class="mdi mdi-keyboard-backspace"></i>&nbsp;&nbsp;
                </a>
                <h4 class="card-title">{{ $title }}</h4>
              </div>
              <form action="{{ route('admin.setting.save')}}" id="settingForm" method="POST">
                <input type="hidden" name="transform_search" value="{{ json_encode(request()->all()) }}">
                <input type="hidden" name="mode" value="{{ $mode }}">
                @if (isset($record->id))
                  <input type="hidden" name="id" value="{{ $record->id }}">
                @endif
                <div class="form-group ">
                  <label for="image">Hình ảnh</label>
                  <span class="ms-2 text-danger">*</span>
                  <input type="file" class="form-control" name="logo" id="preview" accept="image/*" onchange="previewImage()">
                  @if (isset($record->logo))
                    <input type="hidden" name="old_logo" value="{{ $record->logo }}">
                  @endif
                  <br>
                  <div id="preview-image">
                    <img src="{{ asset($path) }}" style="width: 250px; height: 250px">
                  </div>
                  <label class="text-danger error" name="logo"></label>
                </div>
                @foreach ($blade['inputs'] as $col => $value)
                  @switch($value['type'])
                    @case('input')
                      <div class="form-group ">
                        <label for="{{ $col }}">{{ $value['label'] }}</label>
                        @if ($value['required'])
                          <span class=" text-danger">*</span>
                        @endif
                        <input type="text" class="form-control" name="{{ $col }}" id="{{ $col }}" value="{{ isset($record->$col) ? $record->$col : null;}}" placeholder="{{ $value['label'] }}">
                        <label class="text-danger error" name="{{ $col }}"></label>
                      </div>
                     @break
                    @case('datepicker')
                      <div class="form-group">
                        <label for="{{ $col }}">{{ $value['label'] }}</label>
                        @if ($value['required'])
                          <span class="text-danger">*</span>
                        @endif
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                          </div>
                          <input type="text" class="form-control datepicker" placeholder="{{ $value['label'] }}" name="{{ $col }}" value="{{ isset($record->$col) ? $record->$col : null;}}">
                        </div>
                        <label class="text-danger error" name="{{ $col }}"></label>
                      </div>
                     @break
                    @case('textarea')
                      <div class="form-group ">
                        <label for="{{ $col }}">{{ $value['label'] }}</label>
                        @if ($value['required'])
                          <span class="text-danger">*</span>
                        @endif
                        <textarea class="form-control" style="height: 200px" name="{{ $col }}" id="{{ $col }}" placeholder="{{ $value['label'] }}">
                          {{ isset($record->$col) ? $record->$col : null;}}
                        </textarea>
                        <label class="text-danger error" name="{{ $col }}"></label>
                      </div>
                     @break
                    @case('checkbox')
                      <label for="{{ $col }}">{{ $value['label'] }}</label>
                      <div class="form-group form-switch"style="" >
                        <input class="form-check-input" 
                        type="checkbox" 
                        name="{{ $col }}" 
                        {{ (isset($record->$col) && $record->$col == 1) ? 'checked' : null }}ˇ
                        style="width: 40px; height: 20px;">
                    </div>  
                    @break
                  @endswitch
                @endforeach
                
                <button type="submit" class="btn btn-primary me-2">Lưu</button>
              </form>
            </div>
          </div>
        </div>
       
      </div>
    </div>
  {{-- </div> --}}
  <form action="" method="post" id="tmpForm">
    @csrf
  </form>
@endsection
@push('js')
  <script>
    // FORM
    $('form#settingForm').on('submit', function(e){
        e.preventDefault();
        var form = this;
        var idForm = 'form#settingForm';
        $.ajax({
            url     : $(form).attr('action'),
            method  : 'POST',
            data    : new FormData(form),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(form).find('label.error').text('');
                $(form).find('input.is-invalid').removeClass("is-invalid");
            },
            success:function(res){
                if (res.success) {
                    $('form#tmpForm').attr('action', res.url).submit();
                }
            },
            error: function(jqXHR, status, error) {
                switch (jqXHR.status) {
                    case 422:
                        $.each(jqXHR.responseJSON.errors, function (col, msg){
                            $(idForm + ' input[name=' + col + ']').addClass("is-invalid");
                            $(idForm + ' label[name=' + col + ']').addClass("text-danger");
                            $(idForm + ' label[name=' + col + ']').append(msg);
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