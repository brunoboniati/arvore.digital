@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h1 class="mt-4 mb-4">Tipo contato</h1>

            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('tipocontato') }}">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionar usuário Família</li>
                </ol>
            </nav>
            
            @include('partials/alerts') 

            <br>
            <a class="btn btn-sm btn-success mb-4" href="{{ url('tipocontato/create') }}">Adicionar Novo Tipo Contato</a>
            <br>


            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Prefixo </th>
                    <th scope="col">Visível </th>
                    <th scope="col">Editar</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($tipoContato as $tipo)
                        <tr>
                            <th scope="row">{{ $tipo->id }}</td>
                            <td>{{ $tipo->descricao }}</td>
                            <td>{{ $tipo->prefixo }}</td>
                            <td>
                                @if($tipo->visivel == '1') <i class="bi bi-check2-square" style="color:green"></i>
                                @else <i class="bi bi-x-square" style="color:red"></i>
                                @endif
                            </td>
                            <td> 
                                <a href="{{ route('tipocontato.edit',$tipo->id)}}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach          
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
