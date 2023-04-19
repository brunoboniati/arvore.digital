@extends('../base')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Usuários</h1>

    @if(Auth::user()->isAdmin())
        <a class="btn btn-sm btn-success mb-4" href="{{ url('users/create') }}">Adicionar usuário</a>
    @endif
    <br>

    @include('partials/alerts')

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Tipo</th>
            <th scope="col">Ativo</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->isAdmin()) Admin
                        @else Coletor
                        @endif    
                    </td>
                    <td>
                        @if($user->isActive()) <i class="bi bi-check2-square" style="color:green"></i>
                        @else <i class="bi bi-x-square" style="color:red"></i>
                        @endif
                    </td>
                    <td> 
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('users.viewFamilias',$user->id)}}" class="btn btn-light btn-sm me-1">Adm Família</a>
                            <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        @endif 
                    </td>
                </tr>
            @endforeach          
        </tbody>
      </table>
      {{ $users->links() }}
</div>
@endsection
