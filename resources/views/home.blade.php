@if (request()->getHost() === config('tenant.domain_main'))
    @include('admin.home')
@else
    @include('tenants.home')
@endif
