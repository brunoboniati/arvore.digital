
@foreach($filhos as $filho)

<a class="no-link" data-bs-toggle="collapse" href="#collapse{{ $filho->id }}" role="button" aria-expanded="false" aria-controls="collapse">
    @include('pessoas/partials/card',['pessoa' => $filho])
  </a>
</p>
<div class="collapse ms-4" id="collapse{{ $filho->id }}">
  @if(count($filho->filhos()))
      @include('pessoas/partials/child',['filhos' => $filho->filhos()])
  @endif
</div>

@endforeach