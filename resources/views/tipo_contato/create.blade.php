@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Adicionar novo tipo de contato</h1>

            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('tipocontato') }}">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionar tipo contato</li>
                </ol>
            </nav>
            
            @include('partials/alerts') 

            <form action="{{ route('tipocontato.store') }}" method="POST">
                @csrf
                <div class="form-group" >
                    <label for="descricao">Descrição *</label> 
                    <input id="descricao"
                        type="text"
                        name="descricao"
                        class="form-control @error('descricao') is-invalid @enderror">        
                    @error('descricao')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="form-group" >
                    <label for="prefixo">Prefixo</label> 
                    <input id="prefixo"
                        type="text"
                        name="prefixo"
                        class="form-control @error('prefixo') is-invalid @enderror">   
                    @error('prefixo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}" />
        
                <br>
                <input type="submit" value="Cadastrar" class="btn btm-sm btn-dark btn-block">

            </form>
        </div>
    </div>
</div>
@endsection