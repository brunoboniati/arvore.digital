@extends('../base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-4 mt-4">Fazer Login</h1>

            @include('partials/alerts')

            <form method="post" action="{{ route('login.login') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input id="email" 
                        type="text" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="Email" 
                        required="required" 
                        autofocus>
                
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="senha">Senha</label>
                    <input id="senha"
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        value="{{ old('password') }}" 
                        placeholder="Password" 
                        required="required">
                    
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            <br>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="checkbox">
                        <label>
                            <a href="{{ route('forget.password.get') }}">Esqueci minha senha</a>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection