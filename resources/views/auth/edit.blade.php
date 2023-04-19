@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Editar usuário</h1>

            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('users') }}">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar usuário</li>
                </ol>
            </nav>
            
            @include('partials/alerts')     

            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('PATCH') 
                @csrf

                <div class="form-group mb-3">
                    <label for="nome">Nome  <span style="color:red;">*</span></label>
                    <input id="nome"
                        type="name" 
                        class="form-control  @error('name') is-invalid @enderror" 
                        name="name" 
                        value="{{ $user->name }}" 
                        placeholder="Seu nome completo" 
                        required="required" 
                        autofocus>
                    
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="email">Email  <span style="color:red;">*</span></label>
                    <input id="email"
                        type="email" 
                        class="form-control  @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ $user->email }}" 
                        placeholder="email@example.com" 
                        required="required" 
                        autofocus>
                    
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                @if(Auth::user()->isAdmin())
                    <div class="form-group">
                        <label for="tipo"> Tipo de usuário <span style="color:red;">*</span></label>
                        <select id="tipo"
                            name="tipo"
                            class="form-control @error('tipo') is-invalid @enderror">  
                            <option {{ $user->tipo==='0' ? 'selected' : '' }} value="0">Coletor</option>
                            <option {{ $user->tipo==='1' ? 'selected' : '' }} value="1">Administrador geral</option>
                        </select> 
                    </div><br>
                    
                    <div class="form-group">
                        <label for="ativo"> Ativo <span style="color:red;">*</span></label>
                        <select id="ativo"
                            name="ativo"
                            class="form-control @error('ativo') is-invalid @enderror">  
                            <option {{ $user->ativo===1 ? 'selected' : '' }} value="1">Ativo</option>
                            <option {{ $user->ativo===0 ? 'selected' : '' }} value="0">Inativo</option>
                        </select> 
                    </div>                    
                @else
                    <input type="hidden" id="tipo" name="tipo" value="{{ $user->tipo }}" />
                    <input type="hidden" id="ativo" name="ativo" value="{{ $user->ativo }}" />
                @endif
        
                <br>
                <input type="submit" value="Atualizar" class="btn btn-dark btn-block">

            </form>
        </div>
    </div>
</div>
@endsection