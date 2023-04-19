
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome Completo</th>
        <th scope="col">Genero</th>
        <th scope="col">Vivo</th>
        <th scope="col">Pessoa raiz</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{ $pessoa->id }}</td>
            <td>{{ $pessoa->nome_completo }}</td>
            <td>{{ $pessoa->genero=='F' ? "Feminino" : "Masculino" }}</td>
            <td>{{ $pessoa->vivo=='1' ? "Sim" : "Não" }}</td>
            <td>{{ $pessoa->pessoa_id==null ? "Primeira pessoa da família" : $pessoa->pessoa->nome_completo }}</td>
            <td> 
                @if($pessoa->user_id == Auth::user()->id)
                    <a href="{{ url('pessoas/adicionar',$pessoa->id) }}" class="btn btn-sm btn-success">Adicionar descendente</a>
                    <a href="{{ route('pessoas.edit',$pessoa->id)}}" class="btn btn-sm btn-primary">Edit</a>
                @endif
            </td>
        </tr>         
    </tbody>
</table>

<br>
<h2>Pessoa raiz: {{ $pessoa->pai_ou_mae() }}</h2>
@if(!is_null($pessoa->pessoa))
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome Completo</th>
        <th scope="col">Genero</th>
        <th scope="col">Vivo</th>
        <th scope="col">Pessoa raiz</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{ $pessoa->pessoa->id }}</td>
            <td>{{ $pessoa->pessoa->nome_completo }}</td>
            <td>{{ $pessoa->pessoa->genero=='F' ? "Feminino" : "Masculino" }}</td>
            <td>{{ $pessoa->pessoa->vivo=='1' ? "Sim" : "Não" }}</td>
            <td>
                @if(is_null($pessoa->pessoa->pessoa))
                    Primeira pessoa Família
                @else
                {{ $pessoa->pessoa->pessoa->genero==='M' ? 'Pai' : 'Mãe' }}-{{ $pessoa->pessoa->pessoa->nome_completo }}</td>
                @endif
            <td> 
                @if($pessoa->pessoa->user_id == Auth::user()->id)
                    <a href="{{ url('pessoas/adicionar',$pessoa->pessoa->id) }}" class="btn btn-success">Adicionar descendente</a>
                    <a href="{{ route('pessoas.edit',$pessoa->pessoa->id)}}" class="btn btn-primary">Edit</a>
                @endif
            </td>
        </tr>          
    </tbody>
</table>
@endif

<br>

@if($pessoa->irmaos()->count() > 0 || !$pessoa->raiz())
<h2>Irmãos</h2>    
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome Completo</th>
        <th scope="col">Genero</th>
        <th scope="col">Vivo</th>
        <th scope="col">Pessoa raiz</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($pessoa->irmaos() as $irmao)
            <tr>
                <th scope="row">{{ $irmao->id }}</td>
                <td>{{ $irmao->nome_completo }}</td>
                <td>{{ $irmao->genero=='F' ? "Feminino" : "Masculino" }}</td>
                <td>{{ $irmao->vivo=='1' ? "Sim" : "Não" }}</td>
                <td>{{ $irmao->pessoa->nome_completo }}</td>
                <td> 
                    @if($irmao->filhos()->count() > 0)
                        <a href="{{ route('pessoas.show',$irmao->id)}}" class="btn btn-primary">Ver Filhos</a>
                    @else
                        Não tem filhos
                    @endif
                    @if($irmao->user_id == Auth::user()->id)
                        <a href="{{ url('pessoas/adicionar',$irmao->id) }}" class="btn btn-success">Adicionar descendente</a>
                        <a href="{{ route('pessoas.edit',$irmao->id)}}" class="btn btn-primary">Edit</a>
                    @endif
                </td>
            </tr>                 
        @endforeach        
    </tbody>
</table>
@endif

<br>
<h2>Filhos</h2>
@if($pessoa->filhos()->count() > 0)
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome Completo</th>
        <th scope="col">Genero</th>
        <th scope="col">Vivo</th>
        <th scope="col">Pessoa raiz</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($pessoa->filhos() as $filho)
            <tr>
                <th scope="row">{{ $filho->id }}</td>
                <td>{{ $filho->nome_completo }}</td>
                <td>{{ $filho->genero=='F' ? "Feminino" : "Masculino" }}</td>
                <td>{{ $filho->vivo=='1' ? "Sim" : "Não" }}</td>
                <td>{{ is_null($filho->pessoa->pessoa) ? $pessoa->nome_completo : $filho->pessoa->nome_completo }}</td>
                <td>
                    @if($filho->filhos()->count() > 0)
                        <a href="{{ route('pessoas.show',$filho->id)}}" class="btn btn-primary">Ver Filhos</a>
                    @else
                        Não tem filhos
                    @endif
                    @if($filho->user_id == Auth::user()->id)
                        <a href="{{ url('pessoas/adicionar',$filho->id) }}" class="btn btn-success">Adicionar descendente</a>
                         <a href="{{ route('pessoas.edit',$filho->id)}}" class="btn btn-primary">Edit</a>
                    @endif
                </td>
            </tr>                 
        @endforeach        
    </tbody>
</table>
@endif