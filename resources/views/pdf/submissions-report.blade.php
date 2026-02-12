<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Cadastros</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            color: #2d3748;
            font-size: 9px;
        }

        .header {
            margin-bottom: 20px;
            padding: 15px 20px;
            background-color: #2d3748;
        }

        .header-content {
            display: table;
            width: 100%;
        }

        .header-logo {
            display: table-cell;
            vertical-align: middle;
            width: 70px;
        }

        .header-logo img {
            width: 55px;
            height: 55px;
            object-fit: contain;
            border-radius: 4px;
        }

        .header-info {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .header h1 {
            font-family: Arial, sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .header .divider {
            width: 50px;
            height: 2px;
            background-color: #b0b0b0;
            margin: 8px auto 6px;
        }

        .header .subtitle {
            font-size: 9px;
            color: #b0b0b0;
            letter-spacing: 0.5px;
        }

        .header .address {
            font-size: 8px;
            color: #a0aec0;
            margin-top: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
        }

        thead th {
            background-color: #2d3748;
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            padding: 8px 6px;
            text-align: left;
            font-size: 7px;
            border: 1px solid #1a202c;
        }

        tbody td {
            padding: 6px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
            word-wrap: break-word;
        }

        tbody tr:nth-child(even) {
            background-color: #f7fafc;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .text-center {
            text-align: center;
        }

        .col-id {
            width: 35px;
            text-align: center;
        }

        .col-date {
            width: 75px;
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 30px;
            right: 30px;
            padding-top: 8px;
            border-top: 1px solid #cbd5e0;
            font-size: 8px;
            color: #718096;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            @if($logoBase64)
                <div class="header-logo">
                    <img src="{{ $logoBase64 }}" alt="Logo">
                </div>
            @endif
            <div class="header-info">
                <h1>{{ $tenant->name ?? 'Relatório de Cadastros' }}</h1>
                <div class="divider"></div>
                <div class="subtitle">{{ $submissions->count() }} {{ $submissions->count() === 1 ? 'cadastro' : 'cadastros' }} &mdash; Gerado em {{ now()->setTimezone('America/Sao_Paulo')->format('d/m/Y \à\s H:i') }}</div>
                @if($tenant->logradouro || $tenant->cidade)
                    <div class="address">
                        @if($tenant->logradouro){{ $tenant->logradouro }}@endif
                        @if($tenant->numero), {{ $tenant->numero }}@endif
                        @if($tenant->complemento) - {{ $tenant->complemento }}@endif
                        @if($tenant->bairro) &mdash; {{ $tenant->bairro }}@endif
                        @if($tenant->cidade) &mdash; {{ $tenant->cidade }}@endif
                        @if($tenant->estado)/{{ $tenant->estado }}@endif
                        @if($tenant->cep) &mdash; CEP: {{ $tenant->cep }}@endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($submissions->isEmpty())
        <div style="text-align: center; padding: 40px 20px; color: #718096; font-size: 12px;">
            Não existem lançamentos registrados.
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th class="col-id">#</th>
                    @foreach($questions as $question)
                        <th>{{ $question->title }}</th>
                    @endforeach
                    <th class="col-date">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                    <tr>
                        <td class="col-id">{{ $submission->id }}</td>
                        @foreach($questions as $question)
                            <td>
                                @php
                                    $answer = $submission->answers->firstWhere('question_id', $question->id);
                                @endphp
                                {{ $answer?->answer ?? '-' }}
                            </td>
                        @endforeach
                        <td class="col-date">{{ \Carbon\Carbon::parse($submission->created_at)->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        Documento gerado em {{ now()->setTimezone('America/Sao_Paulo')->format('d/m/Y \à\s H:i') }}
    </div>
</body>
</html>
