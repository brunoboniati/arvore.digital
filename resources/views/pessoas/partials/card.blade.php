<div class="row">    
    <div class="col-md-5">
        
        <div class="card" style="width: 21rem;padding:10px;">
            <div class="row g-0">
                <div class="col-md-2">
                    @if($pessoa->genero==='F')
                    <img src="{{ url('storage/users/icon_female.png') }}" class="img-fluid rounded-start mx-auto d-block" width="70px" alt="{{ $pessoa->nome_completo }}">
                    @else
                    <img src="{{ url('storage/users/icon_male.png') }}" class="img-fluid rounded-start mx-auto d-block" width="70px" alt="{{ $pessoa->nome_completo }}">
                    @endif
                </div>
                <div class="col-md-8 ms-4">
                    <h6>
                        @if($pessoa->genero==='F')
                            <i class='bi  bi-circle-fill align-middle' style='font-size: 0.5rem; color: #ED68C8;'></i>
                        @else
                            <i class='bi  bi-circle-fill align-middle' style='font-size: 0.5rem; color: #4A47DB;'></i>
                        @endif
                        {{ $pessoa->nome_completo }} <span class="text-end badge bg-secondary align-middle" style='font-size: 0.7rem; margin-left:15px;'>{{ $pessoa->filhos()->count() > 0 ? $pessoa->filhos()->count() : '' }}</span>
                        <br>{{ $pessoa->pai_ou_mae() }}: {{ $pessoa->pai_mae }}               
                    </h6>
                   
                    <p class="card-text">
                        @if($pessoa->nasc_ano)
                            <i class='bi bi-star-fill align-middle' style="font-size: 0.7rem; color: grey;"></i> {{ $pessoa->nasc_ano }}
                        @endif
                        @if($pessoa->vivo==='0') 
                            <i class="fas fa-cross fa-xs" style="font-size: 0.6rem; color: grey;"></i>
                            {{ $pessoa->obt_ano ? $pessoa->obt_ano : ''}}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 d-flex flex-row mb-3">
        @if($pessoa->contatos_visivel->count() > 0)
            <button type="button" class="btn btn-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#contatos{{ $pessoa->id }}">
                <i class="bi bi-info-circle"></i>
            </button>
        @endif
        @if(!$pessoa->raiz())
            <a href="{{ url('pessoas_arvore',$pessoa->slug) }}" class="btn btn-light btn-sm me-2" title="Ver árvore de {{ $pessoa->nome_completo }}"><i class="bi bi-tree"></i></a>        
        @endif
            @if (!Auth::guest())
            <a href="{{ url('pessoas/adicionarDescendente',$pessoa->id) }}" class="btn btn-light btn-sm me-2"><i class="bi bi-person-plus"></i></a>
            @if($pessoa->isTheOwner(Auth::user()) || Auth::user()->isAdmin() || Auth::user()->isAdminFamily($pessoa->familia) )
                <a href="{{ route('pessoas.edit',$pessoa->id)}}" class="btn btn-light btn-sm me-2"><i class="bi bi-pencil-square"></i></a>
                @if($pessoa->filhos()->count() <= 0)
                    <form action="{{ route('pessoas.destroy',$pessoa->id) }}" method="post" class="d-flex" id='excluir'>
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-bs-title="Deletar {{ $pessoa->nome_completo }} da árvore?" data-bs-message="Tem certeza que deseja deletar esta pessoa? "><i class="bi bi-trash3"></i></button>
                    </form>
                @endif
            @endif
        @endif
    </div>
</div>

<!-- Modal Contatos -->
<div class="modal fade" id="contatos{{ $pessoa->id }}" tabindex="-1" aria-labelledby="contatoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="contatoLabel">Contatos de {{ $pessoa->nome_completo }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table table-striped">                
                <tbody>
                    @foreach($pessoa->contatos_visivel as $contato)                
                        <tr>
                            <td>{{ $contato->descricao }}</td>
                            <td>
                                <a target="_blank" href="{{ $contato->prefixo }}{{ $contato->pivot->descricao }}">{{ $contato->prefixo }}{{ $contato->pivot->descricao }}</a></td>
                        </tr>
                    @endforeach          
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
</div>


<div class="modal" id="confirmDelete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir pessoa da árvore</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
            <div class="modal-body">
                <p>Você tem certeza que deseja deletar esta pessoa?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirm">Sim, eu tenho certeza.</button>
                <button type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal">Não, tire-me daqui.</button>
            </div>
        </div>
    </div>
</div>
