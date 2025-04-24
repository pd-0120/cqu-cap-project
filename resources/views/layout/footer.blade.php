<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">© {{ date('Y') }} </span>
            <a href="{{ route('login') }}" target="_blank" class="text-dark-75 text-hover-primary">{{ config('app.name') }}</a>
        </div>
        <div class="nav nav-dark">
            <a href="{{ route('login') }}" target="_blank" class="nav-link pl-0 pr-2">About</a>
        </div>
    </div>
</div>