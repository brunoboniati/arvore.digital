@extends('../base')

@section('content')
<div class="container mt-4">
    <div class="row mt-4">
        <div class="col-md-8">
            <h3 class="mt-4 mb-4">Adicionar {{ $user->name }} como administradora de Família</h3>
            
            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('users/viewFamilias/'.$user->id) }}">Usuário {{ $user->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Administrar Família</li>
                </ol>
            </nav>
            
            @include('partials/alerts') 

            <form action="{{ route('users.storeFamilias') }}" method="POST">
                @csrf

                <div class="form-group" >
                    <label for="familia_id">Família que vai ser administrada por {{ $user->name }}</label> 
                    <select id="familia_id"
                        class="form-select @error('familia_id') is-invalid @enderror" 
                        name="familia_id" 
                        required>
                        @foreach($familias as $familia)            
                            <option value="{{$familia->id}}">{{$familia->nome_familia}}</option>
                        @endforeach
                    </select>  
                    @error('familia_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>    
                
                <input type="hidden" name="user_id" value="{{ $user->id }}">
        
                <br>
                <input type="submit" value="Salvar" class="btn btn-dark btn-block btn-sm">

            </form>
        </div>
    </div>
</div>

@endsection