@if(Session::has('action_success'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('action_success') }}</p>
@endif