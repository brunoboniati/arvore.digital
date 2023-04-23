@extends('../base')

@section('content')
<div class="container mb-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Editar {{ $pessoa->nome_completo }}</h1>

            <a class="btn btn-sm btn-success mb-4" href="{{ url('pessoas/showContato',$pessoa->id) }}">Gerenciar contatos</a>

            @if(Auth::user()->isAdmin())
                <nav aria-label="breadcrumb" class="mt-4 mb-4">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('pessoas') }}">Pessoas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar {{ $pessoa->nome_completo }}</li>
                    </ol>
                </nav>
            @else
                <nav aria-label="breadcrumb" class="mt-4 mb-4">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('pessoas/'.$pessoa->id) }}">Árvore</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar {{ $pessoa->nome_completo }}</li>
                    </ol>
                </nav>
            @endif
            
            @include('partials/alerts') 

            <form action="{{ route('pessoas.update', $pessoa->id) }}" method="POST">
                @method('PATCH') 
                @csrf

                <div class="row">
                    <div class="mb-3">
                        <label for="nome_completo">Nome Completo *</label> 
                        <input id="nome_completo"
                            type="text"
                            name="nome_completo"
                            value="{{ $pessoa->nome_completo }}"
                            class="form-control @error('nome_completo') is-invalid @enderror">        
                        @error('nome_completo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="genero">Genero *</label> 
                        <select id="genero"
                            name="genero"
                            class="form-select @error('genero') is-invalid @enderror">  
                            <option {{ $pessoa->genero==='F' ? 'selected' : '' }} value="F">Feminino</option>
                            <option {{ $pessoa->genero==='M' ? 'selected' : '' }} value="M">Masculino</option>
                        </select>     
                        @error('genero')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="adotivo">Adotivo *</label> 
                        <select id="adotivo"
                            name="adotivo"                        
                            class="form-select @error('adotivo') is-invalid @enderror">  
                            <option {{ $pessoa->adotivo==='1' ? 'selected' : '' }} value="1">Sim</option>
                            <option {{ $pessoa->adotivo==='0' ? 'selected' : '' }} value="0">Não</option>
                        </select>     
                        @error('adotivo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pai_mae">Nome Pai/Mãe </label> 
                        <input id="pai_mae"
                            type="text"
                            name="pai_mae"
                            value="{{ $pessoa->pai_mae }}"
                            class="form-control @error('pai_mae') is-invalid @enderror">        
                        @error('pai_mae')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="data_nasc">Data Nascimento</label> 
                        <div class="input-group mb-3">
                            <input id="data_nasc"
                                type="number"
                                name="nasc_dia"
                                placeholder="Dia"
                                value="{{ $pessoa->nasc_dia }}"
                                class="form-control @error('nasc_dia') is-invalid @enderror">        
                            @error('nasc_dia')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span class="input-group-text">-</span>
                            <select name="nasc_mes" id="data_nasc" class="form-select @error('nasc_mes') is-invalid @enderror">
                                <option>Escolha o mês</option>
                                <option {{ $pessoa->nasc_mes == "01" ? "selected":"" }} value="01">Janeiro</option>
                                <option {{ $pessoa->nasc_mes == "02" ? "selected":"" }} value="02">Fevereiro</option>
                                <option {{ $pessoa->nasc_mes == "03" ? "selected":"" }} value="03">Março</option>
                                <option {{ $pessoa->nasc_mes == "04" ? "selected":"" }} value="04">Abril</option>
                                <option {{ $pessoa->nasc_mes == "05" ? "selected":"" }} value="05">Maio</option>
                                <option {{ $pessoa->nasc_mes == "06" ? "selected":"" }} value="06">Junho</option>
                                <option {{ $pessoa->nasc_mes == "07" ? "selected":"" }} value="07">Julho</option>
                                <option {{ $pessoa->nasc_mes == "08" ? "selected":"" }} value="08">Agosto</option>
                                <option {{ $pessoa->nasc_mes == "09" ? "selected":"" }} value="09">Setembro</option>
                                <option {{ $pessoa->nasc_mes == "10" ? "selected":"" }} value="10">Outubro</option>
                                <option {{ $pessoa->nasc_mes == "11" ? "selected":"" }} value="11">Novembro</option>
                                <option {{ $pessoa->nasc_mes == "12" ? "selected":"" }} value="12">Dezembro</option>           
                            @error('nasc_mes')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span class="input-group-text">-</span>
                            <input id="data_nasc"
                                type="number"
                                name="nasc_ano"
                                placeholder="Ano"
                                value="{{ $pessoa->nasc_ano }}"
                                class="form-control @error('nasc_ano') is-invalid @enderror">        
                            @error('nasc_ano')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>           
                    </div>

                    <div class="mb-3">
                        <label for="nasc_local">Local Nascimento</label> 
                        <input id="nasc_local"
                            type="text"
                            name="nasc_local"
                            value="{{ $pessoa->nasc_local }}"
                            class="form-control @error('nasc_local') is-invalid @enderror">        
                        @error('nasc_local')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="row mt-3">
                            <div class="form-group col-md-6" id="nasc_latitudeArea">
                                <label>Latitude</label>
                                <input type="text" id="nasc_latitude" name="nasc_latitude" class="form-control" value="{{ $pessoa->nasc_latitude }}" readonly>
                            </div>  
                            <div class="form-group col-md-6" id="nasc_longtitudeArea">
                                <label>Longitude</label>
                                <input type="text" name="nasc_longitude" id="nasc_longitude" class="form-control" value="{{ $pessoa->nasc_longitude }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="vivo">Vivo *</label> 
                        <select id="vivo"
                            name="vivo"
                            class="form-select @error('vivo') is-invalid @enderror">  
                            <option {{ $pessoa->vivo==='1' ? 'selected' : '' }} value="1">Sim</option>
                            <option {{ $pessoa->vivo==='0' ? 'selected' : '' }} value="0">Não</option>
                        </select>     
                        @error('vivo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 d-none" id="obito">
                        <label for="data_nasc">Data Óbito</label> 
                        <div class="input-group mb-3">
                            <input id="data_nasc"
                                type="number"
                                name="obt_dia"
                                placeholder="Dia"
                                value="{{ $pessoa->obt_dia }}"
                                class="form-control @error('obt_dia') is-invalid @enderror">        
                            @error('obt_dia')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span class="input-group-text">-</span>
                            <select name="obt_mes" id="data_obt" class="form-select @error('obt_mes') is-invalid @enderror">
                                <option>Escolha o mês</option>
                                <option {{ $pessoa->obt_mes == "01" ? "selected":"" }} value="01">Janeiro</option>
                                <option {{ $pessoa->obt_mes == "02" ? "selected":"" }} value="02">Fevereiro</option>
                                <option {{ $pessoa->obt_mes == "03" ? "selected":"" }} value="03">Março</option>
                                <option {{ $pessoa->obt_mes == "04" ? "selected":"" }} value="04">Abril</option>
                                <option {{ $pessoa->obt_mes == "05" ? "selected":"" }} value="05">Maio</option>
                                <option {{ $pessoa->obt_mes == "06" ? "selected":"" }} value="06">Junho</option>
                                <option {{ $pessoa->obt_mes == "07" ? "selected":"" }} value="07">Julho</option>
                                <option {{ $pessoa->obt_mes == "08" ? "selected":"" }} value="08">Agosto</option>
                                <option {{ $pessoa->obt_mes == "09" ? "selected":"" }} value="09">Setembro</option>
                                <option {{ $pessoa->obt_mes == "10" ? "selected":"" }} value="10">Outubro</option>
                                <option {{ $pessoa->obt_mes == "11" ? "selected":"" }} value="11">Novembro</option>
                                <option {{ $pessoa->obt_mes == "12" ? "selected":"" }} value="12">Dezembro</option>     
                            @error('obt_mes')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span class="input-group-text">-</span>
                            <input id="data_obt"
                                type="number"
                                name="obt_ano"
                                placeholder="Ano"
                                value="{{ $pessoa->obt_ano }}"
                                class="form-control @error('obt_ano') is-invalid @enderror">        
                            @error('obt_ano')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>           
                    </div>

                    <div class="mb-3 d-none" id="obt_local">
                        <label for="obt_local_input">Local Óbito </label> 
                        <input id="obt_local_input"
                            type="text"
                            name="obt_local"
                            value="{{ $pessoa->obt_local }}"
                            class="form-control @error('obt_local') is-invalid @enderror">        
                        @error('obt_local')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="row mt-3">
                            <div class="form-group col-md-6" id="obt_latitudeArea">
                                <label>Latitude</label>
                                <input type="text" id="obt_latitude" name="obt_latitude" class="form-control" readonly value="{{ $pessoa->obt_latitude }}">
                            </div>  
                            <div class="form-group col-md-6" id="obt_longtitudeArea">
                                <label>Longitude</label>
                                <input type="text" name="obt_longitude" id="obt_longitude" class="form-control" readonly value="{{ $pessoa->obt_longitude }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="observacoes">Observações adicionais</label> 
                        <textarea id="observacoes"
                            name="observacoes"
                            class="form-control @error('observacoes') is-invalid @enderror">{{ $pessoa->observacoes }}</textarea>   
                        @error('observacoes')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <br>
                    <div class="row">
                        <input type="submit" value="Atualizar" class="btn btn-dark btn-sm btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>

<script>
        $(document).ready(function () {

            $("#obt_latitudeArea").addClass("d-none");
            $("#obt_longtitudeArea").addClass("d-none");
            $("#nasc_latitudeArea").addClass("d-none");
            $("#nasc_longtitudeArea").addClass("d-none");

            if( $('#vivo').val()==="0" ){
                $("#obito").removeClass("d-none");
                $("#obt_local").removeClass("d-none");
            }
            
        });

        $(document).on('change','#vivo',function(){
            if( $(this).val()==="0" ){
                $("#obito").removeClass("d-none");
                $("#obt_local").removeClass("d-none");
            } else {
                $("#obito").addClass("d-none");
                $("#obt_local").addClass("d-none");
                $("#obt_dia").val('');
                $("#obt_mes").val('');
                $("#obt_mes").val('');
                $("#obt_local_input").val('');
                $("#obt_latitude").val('');
                $("#obt_longitude").val('');
            }
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);
  
        function initialize() {
            var input = document.getElementById('nasc_local');
            var nasc_local = new google.maps.places.Autocomplete(input);
  
            nasc_local.addListener('place_changed', function () {
                var place = nasc_local.getPlace();
                $('#nasc_latitude').val(place.geometry['location'].lat());
                $('#nasc_longitude').val(place.geometry['location'].lng());
            });

            var input2 = document.getElementById('obt_local_input');
            var obt_local = new google.maps.places.Autocomplete(input2);
  
            obt_local.addListener('place_changed', function () {
                var place = obt_local.getPlace();
                $('#obt_latitude').val(place.geometry['location'].lat());
                $('#obt_longitude').val(place.geometry['location'].lng());

            });
        }
    </script>
@endsection