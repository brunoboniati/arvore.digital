@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Editar tipo de contato</h1>

            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('tipocontato') }}">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar tipo de contato</li>
                </ol>
            </nav>
            
            @include('partials/alerts') 

            <form method="post" action="{{ route('tipocontato.update', $tipo->id) }}">
                @method('PATCH') 
                @csrf
                <div class="form-group" >
                    <label for="descricao">Descrição *</label> 
                    <input id="descricao"
                        type="text"
                        name="descricao"
                        value={{ $tipo->descricao }}
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
                        value={{ $tipo->prefixo }}
                        class="form-control @error('prefixo') is-invalid @enderror">   
                    @error('prefixo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="visivel">Visível *</label> 
                    <select id="visivel"
                        name="visivel"
                        class="form-select @error('visivel') is-invalid @enderror">  
                        <option {{ $tipo->visivel == "0" ? "selected":"" }} value="0">Não visível</option>
                        <option {{ $tipo->visivel == "1" ? "selected":"" }} value="1">Visível</option>
                    </select>     
                    @error('visivel')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <input type="submit" value="Cadastrar" class="btn btn-sm btn-dark btn-block">

            </form>
        </div>
    </div>
</div>
@endsection