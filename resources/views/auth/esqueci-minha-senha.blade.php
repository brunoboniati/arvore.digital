@extends('../base')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Esqueci minha senha</h1>
  
            @include('partials/alerts')
  
            <form action="{{ route('forget.password.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email_address">Email cadastrado no sistema</label>
                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                    @if ($errors->has('email'))
                         <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <br>
                <button type="submit" class="btn btn-primary">
                    Redefinir senha
                </button>
               
            </form>
                        
        </div>
    </div>
</div>

@endsection