@if (isset($request['search']))
    <form action="#" method="POST" id="searchForm">
        @csrf
        @foreach (@$request['search'] as $k => $v)
            <input type="hidden" name="search[{{$k}}]" value="{{ $v }}">
        @endforeach
        <input type="hidden" name="page"  value="{{ $request['page'] }}">
        <input type="hidden" name="id"  value="{{ $request['id'] }}">
    </form>
@endif