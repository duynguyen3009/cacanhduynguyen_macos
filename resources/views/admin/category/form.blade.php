@php
    $blade = [
        'inputs' => require(app_path('Helpers/Form/config/category.php')),
    ];
    $title = 'FORM ADD CATEGORY';
    if (isset($record->id)) {
      $title = 'FORM EDIT CATEGORY';
    }
@endphp
@extends('admin.layout.master')

@section('main')
{{-- <div class="main-panel">    --}}
  
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card main-background">
            <div class="card-body">
              <div class="d-flex">
                <a href="{{ route('admin.category.index', request()->all()) }}" style="text-decoration: none;">
                  <i class="mdi mdi-keyboard-backspace"></i>&nbsp;&nbsp;
                </a>
                <h4 class="card-title">{{ $title }}</h4>
              </div>
              
              <form action="" id="categoryForm" method="POST">
                <input type="hidden" name="transform_search" value="{{ json_encode(request()->all()) }}">
                @if (isset($record->id))
                  <input type="hidden" name="id" value="{{ $record->id }}">
                @endif
                
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
                    @case('checkbox')
                      <div class="form-group ">
                        <label for="{{ $col }}">{{ $value['label'] }}</label>
                        <div class="form-group form-switch"style="" >
                          <input class="form-check-input" 
                          type="checkbox" 
                          name="{{ $col }}" 
                          value="1"
                          {{isset($value['event']) ? $value['event'] : null}}
                          {{ (isset($record->$col) && $record->$col == 1) ? 'checked' : null }}
                          style="width: 40px; height: 20px;">
                        </div>  
                      </div>  
                    @break
                    @case('select2')
                    <div class="form-group ">
                      <label for="{{ $col }}">{{ $value['label'] }}</label>
                      <div class="form-group">
                        @include('components.select', [
                          'name' => $col,
                          'class'=> 'select2',
                          'items' => $listDropDown,
                          'selected' => @$record->$col,
                        ])
                      </div>  
                    </div>  
                    @break
                  @endswitch
                @endforeach
                
                <button type="button" class="btn btn-primary me-2" data-href="{{ route('admin.category.save')}}" onclick="save(this)">Lưu</button>
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
@push('css')
<style>
 
</style>
@endpush
@push('js')
  <script>
    function save(el) {
        var idForm = '#categoryForm';
        $.ajax({
            url     : $(el).data('href'),
            method  : 'POST',
            data    : $(idForm).serialize(),
            
            beforeSend:function(){
                $(idForm).find('label.error').text('');
                $(idForm).find('input.is-invalid').removeClass("is-invalid");
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
    }
  </script>
@endpush