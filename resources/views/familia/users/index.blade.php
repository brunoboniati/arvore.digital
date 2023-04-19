@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1 class="mt-4 mb-4">Administradores da Família {{ $familia->nome_familia }}</h1>

            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('familias') }}">Famílias</a></li>
                <li class="breadcrumb-item active" aria-current="page">Administrador de família</li>
                </ol>
            </nav>
            
            @include('partials/alerts') 
            
            <a class="btn btn-success btn-sm mb-4" href="{{ url('familias/createUser',$familia->id) }}">Adicionar administrador</a>
            <br>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($familia->users as $user)                
                        <tr>
                            <th scope="row">{{ $user->pivot->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a href="{{ route('familias.removeUser', $user->pivot->id)}}" class="btn btn-sm btn-danger">Remover</a>
                            </td>
                        </tr>
                    @endforeach          
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

