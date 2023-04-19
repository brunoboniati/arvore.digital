@extends('../base')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/tree.css') }}">
@endsection
@section('content')
    <div class="container">
        
        <h1 class="mb-4">Família {{ is_null($pessoa->familia) ? '' : $pessoa->familia->nome_familia }}</h1>
        @if(!is_null($pessoa->familia))
        <div class="alert alert-secondary mb-4 col-md-8" role="alert">
            {{ $pessoa->familia->descricao }}
        </div>
        @endif
        
        @if(!$pessoa->raiz())
            <a href="{{ url('familia/'.$pessoa->familia->slug) }}" class="btn btn-sm btn-light mb-4">Árvore completa</a>
        @endif
        
        @include('partials/alerts')

        <a class="no-link" data-bs-toggle="collapse" href="#collapse{{ $pessoa->id }}" role="button" aria-expanded="false" aria-controls="collapse">
            @include('pessoas/partials/card',['pessoa' => $pessoa])
        </a>

        <div class="collapse mt-4 ms-4" id="collapse{{ $pessoa->id }}">
            @if(count($pessoa->filhos()))
                @include('pessoas/partials/child',['filhos' => $pessoa->filhos()])
            @endif
        </div>

    </div>
@endsection


@section('script')
<script>
//Confirm before delete
    $('#confirmDelete').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);
        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    });
    $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
        $(this).data('form').submit();
    });

//Open collapse cards
$(document).ready(function() { 
  var anchor = window.location.hash;
  
  if(anchor){
    const collapseElementList = document.querySelectorAll('.collapse')
    const collapseList = [...collapseElementList].map(collapseEl => new bootstrap.Collapse(collapseEl))

    $('html, body').animate({
        scrollTop: $(anchor).offset().top+700
    }, 'linear');
  }
  
});

</script>
@endsection
