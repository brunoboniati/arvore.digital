@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Criar conta</h1>

            @include('partials/alerts')     

            <form method="post" action="{{ route('register.store') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="nome">Nome  <span style="color:red;">*</span></label>
                    <input id="nome"    
                        type="name" 
                        class="form-control  @error('name') is-invalid @enderror" 
                        name="name" 
                        value="{{ old('name') }}" 
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
                        value="{{ old('email') }}" 
                        placeholder="email@example.com" 
                        required="required" 
                        autofocus>
                    
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="senha">Senha  <span style="color:red;">*</span></label>
                    <input id="senha"
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        value="{{ old('password') }}" 
                        placeholder="Senha" 
                        required="required">
                    
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="confirmarSenha">Confirmar Senha  <span style="color:red;">*</span></label>
                    <input id="confirmarSenha"
                        type="password" 
                        class="form-control @error('confirm') is-invalid @enderror" 
                        name="password_confirmation" 
                        value="{{ old('password_confirmation') }}" 
                        placeholder="Confirmar Senha" 
                        required="required">
                    
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <input type="hidden" id="tipo" name="tipo" value="0" />
                <input type="hidden" id="adm" name="adm" value="0" />
        
                <br>
                <div class="form-group">
                    <input type="submit" value="Cadastrar" class="btn btn-sm btn-dark btn-block">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection