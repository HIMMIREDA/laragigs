@if (session()->has("message"))
    <div x-data="{open : true}" x-show="open" x-transition.duration.300ms x-init="setTimeout(()=>open=false,2000)"  class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
    <p>{{session('message')}}</p>
    </div>
@endif
