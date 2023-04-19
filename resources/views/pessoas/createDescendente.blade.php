@extends('../base')

@section('content')
<div class="container mb-4">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Adicionar nova Pessoa</h1>

            <nav aria-label="breadcrumb" class="mt-4 mb-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Voltar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionar Pessoa</li>
                </ol>
            </nav> 
            
            @include('partials/alerts') 

            <form action="{{ route('pessoas.storeDescendente') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3">
                        <label for="pessoa_id">Pessoa da qual é descendente</label>
                        <input id="nome_pessoa"
                            type="text"
                            class="form-control"
                            readonly
                            value="{{ $raiz->nome_completo }}">
                        <input type="hidden" id="pessoa_id" name="pessoa_id" value="{{ $raiz->id }}" />
                    </div>

                    <div class="mb-3">
                        <label for="nome_completo">Nome Completo *</label> 
                        <input id="nome_completo"
                            type="text"
                            name="nome_completo"
                            value="{{ old('nome_completo') }}"
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
                            <option {{ old("genero") == "F" ? "selected":"" }} value="F">Feminino</option>
                            <option {{ old("genero") == "M" ? "selected":"" }} value="M">Masculino</option>
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
                            <option {{ old("adotivo") == "0" ? "selected":"" }} value="0">Não</option> 
                            <option {{ old("adotivo") == "1" ? "selected":"" }} value="1">Sim</option>
                        </select>     
                        @error('adotivo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @if($raiz->genero == 'F')
                            <label for="pai_mae">Nome Pai</label> 
                        @elseif($raiz->genero == 'M')
                            <label for="pai_mae">Nome Mãe </label>
                        @else
                            <label for="pai_mae">Nome Pai/Mãe </label>
                        @endif
                        <input id="pai_mae"
                            type="text"
                            name="pai_mae"
                            value="{{ old('pai_mae') }}"
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
                                value="{{ old('nasc_dia') }}"
                                class="form-control @error('nasc_dia') is-invalid @enderror">        
                            @error('nasc_dia')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span class="input-group-text">-</span>
                            <select name="nasc_mes" id="data_nasc" class="form-select @error('nasc_mes') is-invalid @enderror">
                                <option>Escolha o mês</option>
                                <option {{ old("nasc_mes") == "01" ? "selected":"" }} value="01">Janeiro</option>
                                <option {{ old("nasc_mes") == "02" ? "selected":"" }} value="02">Fevereiro</option>
                                <option {{ old("nasc_mes") == "03" ? "selected":"" }} value="03">Março</option>
                                <option {{ old("nasc_mes") == "04" ? "selected":"" }} value="04">Abril</option>
                                <option {{ old("nasc_mes") == "05" ? "selected":"" }} value="05">Maio</option>
                                <option {{ old("nasc_mes") == "06" ? "selected":"" }} value="06">Junho</option>
                                <option {{ old("nasc_mes") == "07" ? "selected":"" }} value="07">Julho</option>
                                <option {{ old("nasc_mes") == "08" ? "selected":"" }} value="08">Agosto</option>
                                <option {{ old("nasc_mes") == "09" ? "selected":"" }} value="09">Setembro</option>
                                <option {{ old("nasc_mes") == "10" ? "selected":"" }} value="10">Outubro</option>
                                <option {{ old("nasc_mes") == "11" ? "selected":"" }} value="11">Novembro</option>
                                <option {{ old("nasc_mes") == "12" ? "selected":"" }} value="12">Dezembro</option>
                            </select>       
                            @error('nasc_mes')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span class="input-group-text">-</span>
                            <input id="data_nasc"
                                type="number"
                                name="nasc_ano"
                                value="{{ old('nasc_ano') }}"
                                placeholder="Ano"
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
                            value="{{ old('nasc_local') }}"
                            class="form-control @error('nasc_local') is-invalid @enderror">        
                        @error('nasc_local')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="row mt-3">
                            <div class="form-group col-md-6" id="nasc_latitudeArea">
                                <label>Latitude</label>
                                <input type="text" id="nasc_latitude" name="nasc_latitude" class="form-control" readonly>
                            </div>  
                            <div class="form-group col-md-6" id="nasc_longtitudeArea">
                                <label>Longitude</label>
                                <input type="text" name="nasc_longitude" id="nasc_longitude" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="vivo">Vivo *</label> 
                        <select id="vivo"
                            name="vivo"
                            class="form-select @error('vivo') is-invalid @enderror">  
                            <option {{ old("vivo") == "1" ? "selected":"" }} value="1">Sim</option>
                            <option {{ old("vivo") == "0" ? "selected":"" }} value="0">Não</option>
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
                                value="{{ old('obt_dia') }}"
                                class="form-control @error('obt_dia') is-invalid @enderror">        
                            @error('obt_dia')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span class="input-group-text">-</span>
                            <select name="obt_mes" id="data_nasc" class="form-select @error('obt_mes') is-invalid @enderror">
                                <option>Escolha o mês</option>
                                <option {{ old("obt_mes") == "01" ? "selected":"" }} value="01">Janeiro</option>
                                <option {{ old("obt_mes") == "02" ? "selected":"" }} value="02">Fevereiro</option>
                                <option {{ old("obt_mes") == "03" ? "selected":"" }} value="03">Março</option>
                                <option {{ old("obt_mes") == "04" ? "selected":"" }} value="04">Abril</option>
                                <option {{ old("obt_mes") == "05" ? "selected":"" }} value="05">Maio</option>
                                <option {{ old("obt_mes") == "06" ? "selected":"" }} value="06">Junho</option>
                                <option {{ old("obt_mes") == "07" ? "selected":"" }} value="07">Julho</option>
                                <option {{ old("obt_mes") == "08" ? "selected":"" }} value="08">Agosto</option>
                                <option {{ old("obt_mes") == "09" ? "selected":"" }} value="09">Setembro</option>
                                <option {{ old("obt_mes") == "10" ? "selected":"" }} value="10">Outubro</option>
                                <option {{ old("obt_mes") == "11" ? "selected":"" }} value="11">Novembro</option>
                                <option {{ old("obt_mes") == "12" ? "selected":"" }} value="12">Dezembro</option>
                            </select>         
                            @error('obt_mes')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span class="input-group-text">-</span>
                            <input id="data_obt"
                                type="number"
                                name="obt_ano"
                                placeholder="Ano"
                                value="{{ old('obt_ano') }}"
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
                            value="{{ old('obt_local') }}"
                            class="form-control @error('obt_local') is-invalid @enderror">        
                        @error('obt_local')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="row mt-3">
                            <div class="form-group col-md-6" id="obt_latitudeArea">
                                <label>Latitude</label>
                                <input type="text" id="obt_latitude" name="obt_latitude" class="form-control" readonly>
                            </div>  
                            <div class="form-group col-md-6" id="obt_longtitudeArea">
                                <label>Longitude</label>
                                <input type="text" name="obt_longitude" id="obt_longitude" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="observacoes">Observações adicionais</label> 
                        <textarea id="observacoes"
                            name="observacoes"
                            class="form-control @error('observacoes') is-invalid @enderror">{{ old('obt_dia') }}</textarea>   
                        @error('observacoes')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}" />
                    <input type="hidden" id="familia_id" name="familia_id" value="{{ $raiz->familia_id }}" />

                    <br>
                    <div class="row">   
                        <div class="col">               
                            <button class="btn btn-dark btn-sm col-12" type="submit" name="action" value="cadastrar">Cadastrar</button>
                        </div>
                        <div class="col">                      
                            <button class="btn btn-success btn-sm col-12" type="submit" name="action" value="addContato">Cadastrar e Adicionar Contatos</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
<script type="text/javascript" src="{{ asset('js/googlemaps.js') }}"></script>
@endsection