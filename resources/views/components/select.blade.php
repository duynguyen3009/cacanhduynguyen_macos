<select name="{{ $name }}" class="{{ $class }}">
    @foreach ($items as $k => $item)
        <option value="{{ $k }}" @selected(old($name) ?? $selected == $k)>{{ $item }}</option>
    @endforeach
</select>

{{-- <option value="India" @selected(old('country') ?? $country == 'India')>India</option> --}}