@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Editar família</h1>

            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('familias') }}">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Família</li>
                </ol>
            </nav>
            
            @include('partials/alerts')

            <form method="post" action="{{ route('familias.update', $familia->id) }}">
                @method('PATCH') 
                @csrf
                <div class="form-group" >
                    <label for="pessoa_id">Pessoa raiz da Família:</label> 
                    {{ $familia->raiz->nome_completo }}
                </div>
                <br>
                <div class="form-group" >
                    <label for="nome_familia">Nome da Família <span style="color:red;">*</span></label> 
                    <input id="nome_familia"
                        type="text"
                        name="nome_familia"
                        value="{{ $familia->nome_familia }}"
                        class="form-control @error('nome_familia') is-invalid @enderror">        
                    @error('nome_familia')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="form-group" >
                    <label for="descricao">Breve descrição da Família</label> 
                    <textarea id="descricao"
                        name="descricao"
                        class="form-control @error('descricao') is-invalid @enderror">
                        {{ $familia->descricao }}
                    </textarea>   
                    @error('descricao')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <br>        
                <br>
                <input type="submit" value="Atualizar" class="btn btn-sm btn-dark btn-block">
            </form>
        </div>
    </div>
</div>
@endsection