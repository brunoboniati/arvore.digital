<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Árvore Genealógica</a>        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="d-flex ms-auto order-5">
                <ul class="navbar-nav">              
                @if (Auth::guest())
                    <li class="nav-item"><a href="{{ url('login') }}">Login</a></li>
                    <li class="nav-item ms-3"><a href="{{ url('criarconta') }}">Criar conta</a></li>
                @else                    
                    <li class="nav-item dropdown">
                    <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        @if(Auth()->user()->isAdmin())
                            <li><h6 class="dropdown-header">Admin options</h6></li>
                            <li><a class="dropdown-item" href="{{ url('familias') }}">Famílias</a></li>
                            <li><a class="dropdown-item" href="{{ url('pessoas') }}">Pessoas</a></li>
                            <li><a class="dropdown-item" href="{{ url('tipocontato') }}">Contato</a></li>
                            <li><a class="dropdown-item" href="{{ url('users') }}">Usuários</a></li>
                            <li><a class="dropdown-item" href="{{ url('log') }}">Log de Ações</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header">User options</h6></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ url('users', Auth()->user()->id) }}">Perfil</a></li>
                        <li><a class="dropdown-item" href="{{ url('users/editPassword', Auth()->user()->id) }}">Alterar senha</a></li>
                        <li><a class="dropdown-item" href="{{ url('logout') }}"><i class="icon-off"></i> Sair</a></li>
                    </ul>
                    </li>
                @endif
                </ul>             
            </div>        
        </div>
    </div>
</nav>

