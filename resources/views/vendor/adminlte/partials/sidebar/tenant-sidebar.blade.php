<li class="nav-item">
    <a class="nav-link {{ Route::is('tenants.users*') ? 'active' : '' }}" href="{{ route('tenants.users.index') }}">
        <i class="fa fa-building mr-1"></i>
        <p>
            Escolas
        </p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Route::is('tenants.roles*') ? 'active' : '' }}" href="{{ route('tenants.roles.index') }}">
        <i class="fa fa-graduation-cap mr-1"></i>
        <p>
            Professores
        </p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Route::is('tenants.permissions*') ? 'active' : '' }}"
        href="{{ route('tenants.permissions.index') }}">
        <i class="fa fa-user-graduate mr-1"></i>
        <p>
            Alunos
        </p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Route::is('tenants.permissions*') ? 'active' : '' }}"
        href="{{ route('tenants.permissions.index') }}">
        <i class="fa fa-clipboard mr-1"></i>
        <p>
            Notas
        </p>
    </a>
</li>

<li class="nav-item {{ Route::is('tenants.users*', 'tenants.roles*', 'tenants.permissions*') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Route::is('tenants.users*', 'tenants.roles*', 'tenants.permissions*') ? 'active' : '' }}">
        <i class="fa fa-lock mr-1"></i>
        <p>
            Controle de Acesso
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.users*') ? 'active' : '' }}"
                href="{{ route('tenants.users.index') }}">
                <i class="fa fa-users mr-1 ml-2"></i>
                <p>
                    Usuários
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.roles*') ? 'active' : '' }}"
                href="{{ route('tenants.roles.index') }}">
                <i class="fa fa-user-lock mr-1 ml-2"></i>
                <p>
                    Perfis
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.permissions*') ? 'active' : '' }}"
                href="{{ route('tenants.permissions.index') }}">
                <i class="fa fa-unlock mr-1 ml-2"></i>
                <p>
                    Permissões
                </p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{ Route::is('tenants.users*', 'tenants.roles*', 'tenants.permissions*') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Route::is('tenants.users*', 'tenants.roles*', 'tenants.permissions*') ? 'active' : '' }}">
        <i class="fa fa-file-csv mr-1"></i>
        <p>
            Importações
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.users*') ? 'active' : '' }}"
                href="{{ route('tenants.users.index') }}">
                <i class="fa fa-users mr-1 ml-2"></i>
                <p>
                   Escolas
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.roles*') ? 'active' : '' }}"
                href="{{ route('tenants.roles.index') }}">
                <i class="fa fa-user-lock mr-1 ml-2"></i>
                <p>
                    Professores
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.permissions*') ? 'active' : '' }}"
                href="{{ route('tenants.permissions.index') }}">
                <i class="fa fa-unlock mr-1 ml-2"></i>
                <p>
                    Alunos
                </p>
            </a>
        </li>
    </ul>
</li>
