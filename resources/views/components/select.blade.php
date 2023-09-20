<select name="{{ $name }}" class="{{ $class }}" placeholder = "">
    @foreach ($items as $k => $item)
        <option value="{{ $k }}" @selected(old($name) ?? $selected == $k)>{{ $item }}</option>
    @endforeach
</select> 