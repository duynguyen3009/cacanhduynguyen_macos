@php
  $bgColor = 'background: #00cec9';
@endphp
<form action="{{ url()->current() }}" method="GET" id="searchForm">
  <ul  class="d-flex justify-content-between">
  <li class="status">
    <input type="hidden" name="search[status]" value="{{ request('search.status', null)}}">
    <input type="hidden" name="page" value="{{ request('page', 1)}}">
      <button class="btn btn-secondary btn-sm" 
              style="{{ request('search.status') == '1' ? $bgColor : ''}}" 
              name="" 
              data-value="1" 
              type="button" 
              onclick="searchStatus(this)"> 
        Active (<strong>{{ $dataLoadSearch['active']}}</strong>)
      </button>
      <button class="btn btn-secondary btn-sm"
              style="{{ request('search.status') == '0' ? $bgColor : ''}}" 
              name="" 
              data-value="0" 
              type="button" 
              onclick="searchStatus(this)"> 
        Inactive (<strong>{{ $dataLoadSearch['inactive']}}</strong>)
      </button>
  </li>

  <li>
    @include('components.select', [
      'name' => 'search[sort]',
      'class'=> 'form-select',
      'items' => $dataLoadSearch['sort'],
      'selected' => request('search.sort'), // giá trị nhập
    ])
  </li>

  <li>
    <div class="form-group">
      <div class="input-group">
        @include('components.select', [
          'name' => 'search[key_search]',
          'class'=> 'form-select',
          'items' => $dataLoadSearch['key_search'],
          'selected' => request('search.key_search')
        ])
        <input type="text" class="form-control" style="height: 37px" placeholder="Nhập từ khóa" name="search[value_search]" value="{{ request('search.value_search')}}">
        <button type="button" class="btn btn-primary btn-sm" name="btnSearch" onclick="$('#searchForm').submit();">Tìm</button>
      </div>
    </div>
  </li>
</ul>
</form>

<style>
  li.status {
    margin-left: -20px;
  }
  ul {
    list-style-type: none;
  }
</style>


