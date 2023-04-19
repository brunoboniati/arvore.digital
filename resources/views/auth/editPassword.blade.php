@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Alterar minha senha</h1>

            @include('partials/alerts')     

            <form method="post" action="{{ route('users.updatePassword', $user->id) }}">
                @method('PATCH') 
                @csrf

                <div class="form-group mb-3">
                    <label for="password_old">Senha atual  <span style="color:red;">*</span></label>
                    <input id="password_old"
                        type="password" 
                        class="form-control  @error('password_old') is-invalid @enderror" 
                        name="password_old" 
                        required="required" 
                        autofocus>
                    
                    @error('password_old')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password">Nova Senha<span style="color:red;">*</span></label>
                    <input id="password"
                        type="password" 
                        class="form-control  @error('password') is-invalid @enderror" 
                        name="password" 
                        required="required" 
                        autofocus>
                    
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirmar Senha <span style="color:red;">*</span></label>
                    <input id="password_confirmation"
                        type="password" 
                        class="form-control  @error('password_confirmation') is-invalid @enderror" 
                        name="password_confirmation" 
                        required="required" 
                        autofocus>
                    
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                <br>
                <input type="submit" value="Alterar senha" class="btn btn-dark btn-block">

            </form>
        </div>
    </div>
</div>
@endsection