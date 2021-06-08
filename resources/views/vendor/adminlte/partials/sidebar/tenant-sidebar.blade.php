<li class="nav-item">
    <a class="nav-link {{ Route::is('tenants.schools*') ? 'active' : '' }}" href="{{ route('tenants.schools.index') }}">
        <i class="fa fa-building mr-1"></i>
        <p>
            Escolas
        </p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Route::is('tenants.teachers*') ? 'active' : '' }}" href="{{ route('tenants.teachers.index') }}">
        <i class="fa fa-graduation-cap mr-1"></i>
        <p>
            Professores
        </p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Route::is('tenants.students*') ? 'active' : '' }}"
        href="{{ route('tenants.students.index') }}">
        <i class="fa fa-user-graduate mr-1"></i>
        <p>
            Alunos
        </p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Route::is('tenants.grades*') ? 'active' : '' }}"
        href="{{ route('tenants.grades.index') }}">
        <i class="fa fa-clipboard mr-1"></i>
        <p>
            Notas
        </p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Route::is('tenants.assessments*') ? 'active' : '' }}"
        href="{{ route('tenants.assessments.index') }}">
        <i class="fa fa-clipboard mr-1"></i>
        <p>
            Avaliações
        </p>
    </a>
</li>

<li class="nav-item {{ Route::is('tenants.users*', 'tenants.roles*', 'tenants.permissions*', 'tenants.modules*') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Route::is('tenants.users*', 'tenants.roles*', 'tenants.permissions*', 'tenants.modules*') ? 'active' : '' }}">
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
        @if(env('APP_ENV') == 'local')
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.permissions*') ? 'active' : '' }}"
                href="{{ route('tenants.permissions.index') }}">
                <i class="fa fa-unlock mr-1 ml-2"></i>
                <p>
                    Permissões
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.modules*') ? 'active' : '' }}"
                href="{{ route('tenants.modules.index') }}">
                <i class="fa fa-unlock mr-1 ml-2"></i>
                <p>
                    Módulos
                </p>
            </a>
        </li>
        @endif
    </ul>
</li>

<li class="nav-item {{ Route::is('tenants.imports*') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Route::is('tenants.imports*') ? 'active' : '' }}">
        <i class="fa fa-file-csv mr-1"></i>
        <p>
            Importações
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.imports.schools*') ? 'active' : '' }}"
                href="{{ route('tenants.imports.schools.index') }}">
                <i class="fa fa-users mr-1 ml-2"></i>
                <p>
                   Escolas
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.imports.teachers*') ? 'active' : '' }}"
                href="{{ route('tenants.imports.teachers.index') }}">
                <i class="fa fa-user-lock mr-1 ml-2"></i>
                <p>
                    Professores
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('tenants.imports.students*') ? 'active' : '' }}"
                href="{{ route('tenants.imports.students.index') }}">
                <i class="fa fa-unlock mr-1 ml-2"></i>
                <p>
                    Alunos
                </p>
            </a>
        </li>
    </ul>
</li>
