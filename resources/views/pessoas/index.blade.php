@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1 class="mt-4 mb-4">Pessoas</h1>

            @if(Auth::user()->isAdmin())
                <a class="btn btn-sm btn-success mb-4" href="{{ url('pessoas/create') }}">Adicionar pessoa</a>
            @endif
            <br>
            
            @include('partials/alerts') 

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome Completo</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Vivo</th>
                    <th scope="col">Pessoa raiz</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($pessoas as $pessoa)
                
                        <tr>
                            <th scope="row">{{ $pessoa->id }}</td>
                            <td>{{ $pessoa->nome_completo }}</td>
                            <td>{{ $pessoa->genero=='F' ? "Feminino" : "Masculino" }}</td>
                            <td>{{ $pessoa->vivo=='1' ? "Sim" : "Não" }}</td>
                            <td>{{ $pessoa->pessoa_id==null ? "Primeira pessoa da família" : $pessoa->pessoa->nome_completo }}</td>
                            <td> 
                                <a href="{{ route('pessoas.show',$pessoa->id)}}" class="btn btn-sm btn-secondary">Árvore</a>
                                <a href="{{ route('pessoas.showContato',$pessoa->id)}}" class="btn btn-sm btn-secondary">Contatos</a>
                                <a href="{{ route('pessoas.edit',$pessoa->id)}}" class="btn btn-sm btn-primary">Editar</a>
                            </td>
                        </tr>
                    @endforeach          
                </tbody>
            </table>
            {{ $pessoas->links() }}
        </div>
    </div>
</div>
@endsection

