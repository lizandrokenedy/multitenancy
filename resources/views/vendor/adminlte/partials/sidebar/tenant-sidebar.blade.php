@can('tela-escolas-administrativo-visualizar')
    <li class="nav-item">
        <a class="nav-link {{ Route::is('tenants.schools*') ? 'active' : '' }}"
            href="{{ route('tenants.schools.index') }}">
            <i class="fa fa-building mr-1"></i>
            <p>
                Escolas
            </p>
        </a>
    </li>
@endcan
@can('tela-professores-administrativo-visualizar')
    <li class="nav-item">
        <a class="nav-link {{ Route::is('tenants.teachers*') ? 'active' : '' }}"
            href="{{ route('tenants.teachers.index') }}">
            <i class="fa fa-graduation-cap mr-1"></i>
            <p>
                Professores
            </p>
        </a>
    </li>
@endcan
@can('tela-alunos-administrativo-visualizar')
    <li class="nav-item">
        <a class="nav-link {{ Route::is('tenants.students*') ? 'active' : '' }}"
            href="{{ route('tenants.students.index') }}">
            <i class="fa fa-user-graduate mr-1"></i>
            <p>
                Alunos
            </p>
        </a>
    </li>
@endcan
{{-- @can('tela-notas-administrativo-visualizar')
    <li class="nav-item">
        <a class="nav-link {{ Route::is('tenants.grades*') ? 'active' : '' }}"
            href="{{ route('tenants.grades.index') }}">
            <i class="fa fa-clipboard mr-1"></i>
            <p>
                Notas
            </p>
        </a>
    </li>
@endcan --}}
@can('tela-avaliacoes-administrativo-visualizar')
    <li class="nav-item">
        <a class="nav-link {{ Route::is('tenants.assessments*') ? 'active' : '' }}"
            href="{{ route('tenants.assessments.index') }}">
            <i class="fa fa-clipboard mr-1"></i>
            <p>
                Avaliações
            </p>
        </a>
    </li>
@endcan


<li class="nav-item">
    <a class="nav-link {{ Route::is('tenants.reports*') ? 'active' : '' }}"
        href="{{ route('tenants.reports.index') }}">
        <i class="fa fa-chart-pie mr-1"></i>
        <p>
            Relatórios
        </p>
    </a>
</li>

@canany(['tela-usuarios-administrativo-visualizar', 'tela-perfis-administrativo-visualizar'])
    <li
        class="nav-item {{ Route::is('tenants.users*', 'tenants.roles*', 'tenants.permissions*', 'tenants.modules*') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ Route::is('tenants.users*', 'tenants.roles*', 'tenants.permissions*', 'tenants.modules*') ? 'active' : '' }}">
            <i class="fa fa-lock mr-1"></i>
            <p>
                Configurações
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('tela-usuarios-administrativo-visualizar')
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('tenants.users*') ? 'active' : '' }}"
                        href="{{ route('tenants.users.index') }}">
                        <i class="fa fa-users mr-1 ml-2"></i>
                        <p>
                            Usuários
                        </p>
                    </a>
                </li>
            @endcan
            @can('tela-perfis-administrativo-visualizar')
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('tenants.roles*') ? 'active' : '' }}"
                        href="{{ route('tenants.roles.index') }}">
                        <i class="fa fa-user-lock mr-1 ml-2"></i>
                        <p>
                            Perfis
                        </p>
                    </a>
                </li>
            @endcan
            @if (env('APP_ENV') == 'local')
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
@endcanany

{{-- @if (env('APP_ENV') == 'local')
    <li
        class="nav-item {{ Route::is('tenants.schools*', 'tenants.students*', 'tenants.teachers*') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ Route::is('tenants.schools*', 'tenants.students*', 'tenants.teachers*') ? 'active' : '' }}">
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
@endif --}}
