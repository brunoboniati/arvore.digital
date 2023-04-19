@extends('../base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-4 mb-4">Log</h1>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Tabela</th>
                    <th scope="col">Evento</th>
                    <th scope="col">ID do registro</th>
                    <th scope="col">Id do usuário</th>
                    <th scope="col">Dados</th>
                    <th scope="col">Data</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($activitylog as $log)
                
                        <tr>
                            <th scope="row">{{ $log->id }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->subject_type }}</td>
                            <td>{{ $log->event }}</td>
                            <td>{{ $log->subject_id }}</td>
                            <td>{{ $log->causer_id }}</td>
                            <td>{{ $log->properties }}</td>
                            <td>{{ $log->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach          
                </tbody>
            </table>

            {{ $activitylog->links() }}
        </div>
    </div>
</div>
@endsection

