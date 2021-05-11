@if ($route)
    <a href="{{ route($route) }}" class="btn-sm btn-primary pr-3">
        <i class="fa fa-plus mr-2"></i>
        {{ isset($title) ? $title : 'Novo' }}
    </a>
@endif
