@extends('../base')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Redefinir Senha</h1>

            @include('partials/alerts')
  
            <form action="{{ route('reset.password.post') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email_address">EMail cadastrado no sistema</label>
                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif                   
                </div>

                <div class="form-group">
                    <label for="password">Nova Senha</label>
                    <input type="password" id="password" class="form-control" name="password" required autofocus>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirmar Senha</label>
                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                
                <button type="submit" class="btn btn-primary">
                    Reset Password
                </button>
                
            </form>
                        
        </div>
    </div>
</div>

@endsection