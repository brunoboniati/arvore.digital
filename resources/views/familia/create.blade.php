@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Adicionar nova Família</h1>

            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('familias') }}">Família</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionar Família</li>
                </ol>
            </nav>
            
            @include('partials/alerts') 
     

            <form action="{{ route('familias.store') }}" method="POST">
                @csrf

                <div class="form-group" >
                    <label for="pessoa_raiz">Pessoa raiz da Família</label> 
                    <input id="pessoa_raiz"
                        type="text"
                        value="{{ $pessoa->nome_completo }}"
                        readonly
                        class="form-control @error('pessoa_id') is-invalid @enderror"> 
                    <input type="hidden" value="{{ $pessoa->id }}" name="pessoa_id">  
                    @error('pessoa_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="form-group" >
                    <label for="nome_familia">Nome da Família *</label> 
                    <input id="nome_familia"
                        type="text"
                        name="nome_familia"
                        value="{{ old('nome_familia') }}"
                        class="form-control @error('nome_familia') is-invalid @enderror">        
                    @error('nome_familia')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="form-group" >
                    <label for="descricao">Breve descrição da Família *</label> 
                    <textarea id="descricao"
                        name="descricao"
                        class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao') }}</textarea>   
                    @error('descricao')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}" />
        
                <br>
                <input type="submit" value="Cadastrar" class="btn btn-dark btn-block">

            </form>
        </div>
    </div>
</div>
@endsection