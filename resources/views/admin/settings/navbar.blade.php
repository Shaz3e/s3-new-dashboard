<a href="{{ route('admin.settings.application') }}"
    class="list-group-item list-group-item-action{{ request()->routeIs('admin.settings.application') ? ' active' : '' }}">
    Application Setting
</a>
<a href="{{ route('admin.settings.email') }}"
    class="list-group-item list-group-item-action{{ request()->routeIs('admin.settings.email') ? ' active' : '' }}">
    Email Settings
</a>


{{-- <div class="list-group"> --}}
