@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1 class="mt-4 mb-4">{{ $user->name }} - Administrador de Família</h1>

            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('users') }}">Usuários</a></li>
                <li class="breadcrumb-item active" aria-current="page">Administrador de família</li>
                </ol>
            </nav>
            
            @include('partials/alerts') 
            
            <a class="btn btn-success btn-sm mb-4" href="{{ url('users/createFamilias',$user->id) }}">Adicionar Família</a>
            <br>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Família</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($user->familias as $familia)                
                        <tr>
                            <th scope="row">{{ $familia->pivot->id }}</td>
                            <td>{{ $familia->nome_familia }}</td>
                            <td>
                                <a href="{{ route('users.removeFamilias', $familia->pivot->id)}}" class="btn btn-sm btn-danger">Remover</a>
                            </td>
                        </tr>
                    @endforeach          
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

