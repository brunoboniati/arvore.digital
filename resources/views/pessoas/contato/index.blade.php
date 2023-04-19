@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1 class="mt-4 mb-4">Contatos de {{ $pessoa->nome_completo }}</h1>

            @if(Auth::user()->isAdmin())
                <nav aria-label="breadcrumb" class="mt-4 mb-4">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('pessoas') }}">Pessoas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contatos de {{ $pessoa->nome_completo }}</li>
                    </ol>
                </nav>
            @else
                <nav aria-label="breadcrumb" class="mt-4 mb-4">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('pessoas/'.$pessoa->id) }}">Árvore</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contatos de {{ $pessoa->nome_completo }}</li>
                    </ol>
                </nav>
            @endif
            
            @include('partials/alerts') 
            
            <a class="btn btn-sm btn-success mb-4" href="{{ url('pessoas/adicionarContato',$pessoa->id) }}">Adicionar contato</a>
            <br>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Contato</th>
                    <th scope="col">Descrição</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($pessoa->contatos as $contato)                
                        <tr>
                            <th scope="row">{{ $contato->pivot->id }}</td>
                            <td>{{ $contato->descricao }}</td>
                            <td>
                                <a target="_blank" href="{{ $contato->prefixo }}{{ $contato->pivot->descricao }}">{{ $contato->prefixo }}{{ $contato->pivot->descricao }}</a></td>
                            <td>
                                <a href="{{ route('pessoas.deleteContato',$contato->pivot->id)}}" class="btn btn-sm btn-danger">Apagar</a>
                            </td>
                        </tr>
                    @endforeach          
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

