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

            <p>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Filtros
                </a>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <form action="{{ route('projects.index') }}" method="GET" role="search">

                        <div class="input-group">
                            <span class="input-group-btn mr-5 mt-1">
                                <button class="btn btn-info" type="submit" title="Search projects">
                                    <span class="fas fa-search"></span>
                                </button>
                            </span>
                            <input type="text" class="form-control mr-2" name="term" placeholder="Search projects" id="term">
                            <a href="{{ route('projects.index') }}" class=" mt-1">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button" title="Refresh page">
                                        <span class="fas fa-sync-alt"></span>
                                    </button>
                                </span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
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
                                <a href="{{ route('showArvore',$pessoa->slug)}}" class="btn btn-sm btn-secondary">Árvore</a>
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

