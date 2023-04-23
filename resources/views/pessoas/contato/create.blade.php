@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Adicionar contato a {{ $pessoa->nome_completo }}</h1>

            @if(Auth::user()->isAdmin())
                <nav aria-label="breadcrumb" class="mt-4 mb-4">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('pessoas') }}">Pessoas</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('pessoas/'.$pessoa->id) }}">Árvore</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('pessoas/showContato/'.$pessoa->id) }}">Contatos de {{ $pessoa->nome_completo }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Adicionar contato a {{ $pessoa->nome_completo }}</li>
                    </ol>
                </nav>
            @else
                <nav aria-label="breadcrumb" class="mt-4 mb-4">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('pessoas/'.$pessoa->id) }}">Árvore</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('pessoas/showContato/'.$pessoa->id) }}">Contatos de {{ $pessoa->nome_completo }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Adicionar contato a {{ $pessoa->nome_completo }}</li>
                    </ol>
                </nav>
            @endif
            
            @include('partials/alerts') 
     

            <form action="{{ route('pessoas.storeContato') }}" method="POST">
                @csrf

                <div class="form-group" >
                    <label for="tipo_contato">Tipo contato</label> 
                    <select id="tipo_contato"
                        class="form-select @error('tipo_contato') is-invalid @enderror" 
                        name="tipo_contato" 
                        required>
                        @foreach($tipoContato as $tipo)            
                            <option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
                        @endforeach
                    </select>  
                    @error('tipo_contato')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <p id="prefixo"></p>
                <div class="form-group" >
                    <label for="descricao">Descrição</label> 
                    <input id="descricao"
                        type="text"
                        name="descricao"
                        class="form-control @error('descricao') is-invalid @enderror">        
                    @error('descricao')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="pessoa_id" value="{{ $pessoa->id }}">
               
        
                <br>
                <input type="submit" value="Salvar" class="btn btn-sm btn-dark btn-block">

            </form>
        </div>
    </div>
</div>

@endsection