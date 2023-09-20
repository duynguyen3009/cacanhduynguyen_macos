@php
    $blade = [
        'inputs' => require(app_path('Helpers/Form/config/slider.php')),
    ];
    $path = 'assets/images/default.jpeg';
    $title = 'FORM ADD SLIDER';
    if (isset($record->id) && isset($record->image)) {
      $path = 'storage/sliders/' . @$record->image;
      $title = 'FORM EDIT SLIDER';
    }
@endphp
@extends('admin.layout.master')

@section('main')
    <div class="content-wrapper ">
      <form action="{{ route('admin.slider.save')}}" id="sliderForm" method="POST">
      <div class="row ">
        <div class="col-md-6 grid-margin stretch-card ">
          <div class="card main-background">
            <div class="card-body">
              <div class="d-flex">
                <a href="{{ route('admin.slider.index', request()->all()) }}" style="text-decoration: none;">
                  <i class="mdi mdi-keyboard-backspace"></i>&nbsp;&nbsp;
                </a>
                <h4 class="card-title">{{ $title }}</h4>
              </div>
              
              {{-- <form action="{{ route('admin.slider.save')}}" id="sliderForm" method="POST"> --}}
                <input type="hidden" name="transform_search" value="{{ json_encode(request()->all()) }}">
                @if (isset($record->id))
                  <input type="hidden" name="id" value="{{ $record->id }}">
                @endif
                {{-- <div class="form-group ">
                  <label for="image">Hình ảnh</label>
                  <span class="ms-2 text-danger">*</span>
                  <input type="file" class="form-control" name="image" id="preview" accept="image/*" onchange="previewImage()">
                    @if (isset($record->image))
                      <input type="hidden" name="old_image" value="{{ $record->image }}">
                    @endif
                    <br>
                    <div id="preview-image">
                      <img src="{{ asset($path) }}" style="width: 100%; height: 250px">
                    </div>
                  <label class="text-danger error" name="image"></label>
                </div> --}}
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
                    <div class="form-group">
                      <label for="{{ $col }}">{{ $value['label'] }}</label>
                      <div class="form-group form-switch status" >
                        <input class="form-check-input" 
                        type="checkbox" 
                        name="{{ $col }}" 
                        {{ (isset($record->$col) && $record->$col == 1) ? 'checked' : null }}
                        style="width: 40px; height: 20px;">
                      </div> 
                    </div>
                    @break
                  @endswitch
                @endforeach
                
                <button type="submit" class="btn btn-primary me-2">Lưu</button>
              </div>
            </div>
          </div>
          
          <div class="col-md-6 grid-margin" >
            <div class="card main-background" style="height: 400px">
              <div class="card-body">
                <div class="form-group ">
                  <label for="image">Hình ảnh</label>
                  <span class="ms-2 text-danger">*</span>
                  <input type="file" class="form-control" name="image" id="preview" accept="image/*" onchange="previewImage()">
                    @if (isset($record->image))
                      <input type="hidden" name="old_image" value="{{ $record->image }}">
                    @endif
                    <br>
                    <div id="preview-image">
                      <img src="{{ asset($path) }}" style="width: 100%; height: 250px">
                    </div>
                  <label class="text-danger error" name="image"></label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  {{-- </div> --}}
  <form action="" method="post" id="tmpForm">
    @csrf
  </form>
@endsection
@push('css')
<style>
  .form-group {
    margin-bottom: 0px;
  }

  .status {
    margin-bottom: 10px;
  }

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
                      console.log(jqXHR.responseJSON.errors);
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