@extends('../base')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Minhas Famílias</h1>

    @if(Auth::user()->isAdmin())
        <a class="btn btn-sm btn-success mb-4" href="{{ url('familias/create') }}">Adicionar família</a>
    @endif
    <br>

    @include('partials/alerts')

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome Família</th>
            <th scope="col">Descrição</th>
            <th scope="col">Pessoa Raiz</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach($familias as $familia)
                <tr>
                    <th scope="row">{{ $familia->id }}</td>
                    <td>{{ $familia->nome_familia }}</td>
                    <td>{{ $familia->descricao }}</td>
                    <td>{{ $familia->raiz->nome_completo }}</td>
                    <td> 
                        <a href="{{ route('pessoas.show', $familia->pessoa_id)}}" class="btn btn-sm btn-secondary">Ver Árvore</a>
                        @if($familia->isAdminFamily(auth()->user()->id) OR auth()->user()->isAdmin())
                            <!--<a href="{{ route('pessoas.create')}}" class="btn btn-success">Add Pessoa</a>-->
                            <a href="{{ route('familias.viewUser',$familia->id)}}" class="btn btn-sm btn-light">Add Administrador</a>
                            <a href="{{ route('familias.edit',$familia->id)}}" class="btn btn-sm btn-primary">Edit</a>
                        @endif 
                    </td>
                </tr>
            @endforeach          
        </tbody>
      </table>
      {{ $familias->links() }}
</div>
@endsection
