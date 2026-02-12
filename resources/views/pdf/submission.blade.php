<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submissão #{{ $submission->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 50px;
            color: #2d3748;
            line-height: 1.6;
        }

        .header {
            margin-bottom: 40px;
            padding: 20px 25px;
            background-color: #2d3748;
        }

        .header-content {
            display: table;
            width: 100%;
        }

        .header-logo {
            display: table-cell;
            vertical-align: middle;
            width: 80px;
        }

        .header-logo img {
            width: 60px;
            height: 60px;
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
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .header .subtitle {
            font-size: 10px;
            color: #b0b0b0;
            letter-spacing: 0.5px;
        }

        .header .divider {
            width: 60px;
            height: 2px;
            background-color: #b0b0b0;
            margin: 10px auto 8px;
        }

        .header .address {
            font-size: 9px;
            color: #a0aec0;
            margin-top: 4px;
        }

        .content-section {
            margin-top: 40px;
        }

        .section-title {
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #000;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .answer-item {
            margin-bottom: 16px;
            page-break-inside: avoid;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .answer-item .question {
            font-weight: 600;
            font-size: 11px;
            color: #2d3748;
            background-color: #e2e8f0;
            padding: 8px 12px;
        }

        .answer-item .answer {
            font-size: 11px;
            color: #2d3748;
            background-color: #ffffff;
            padding: 8px 12px;
        }

        .footer {
            position: fixed;
            bottom: 30px;
            left: 50px;
            right: 50px;
            padding-top: 10px;
            border-top: 1px solid #cbd5e0;
            font-size: 9px;
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
                <h1>{{ $tenant->name ?? 'Relatório de Submissão' }}</h1>
                <div class="divider"></div>
                <div class="subtitle">Submissão #{{ $submission->id }} &mdash; {{ \Carbon\Carbon::parse($submission->created_at)->setTimezone('America/Sao_Paulo')->format('d/m/Y') }}</div>
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

    <div class="content-section">
        <h2 class="section-title">Respostas</h2>

        @foreach($submission->answers as $answer)
            <div class="answer-item">
                <div class="question">{{ $answer->question->title }}</div>
                <div class="answer">{{ $answer->answer ?? 'Não respondido' }}</div>
            </div>
        @endforeach
    </div>

    <div class="footer">
        Documento gerado em {{ now()->setTimezone('America/Sao_Paulo')->format('d/m/Y \à\s H:i') }}
    </div>
</body>
</html>
