@extends('../base')

@section('content')
<div class="container mt-4">
    <div class="row mt-4">
        <div class="col-md-8">
            <h3 class="mt-4 mb-4">Adicionar administrador a Família {{ $familia->nome_familia }}</h3>
            
            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('familias/viewUser/'.$familia->id) }}">Família {{ $familia->nome_familia }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionar administrador a Família</li>
                </ol>
            </nav>
            
            @include('partials/alerts') 

            <form action="{{ route('familias.storeUser') }}" method="POST">
                @csrf

                <div class="form-group" >
                    <label for="user_id">Novo administrador para família {{ $familia->nome_familia }}</label> 
                    <select id="user_id"
                        class="form-select @error('user_id') is-invalid @enderror" 
                        name="user_id" 
                        required>
                        @foreach($usuarios as $user)            
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>  
                    @error('user_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>    
                
                <input type="hidden" name="familia_id" value="{{ $familia->id }}">
        
                <br>
                <input type="submit" value="Salvar" class="btn btn-dark btn-block btn-sm">

            </form>
        </div>
    </div>
</div>

@endsection