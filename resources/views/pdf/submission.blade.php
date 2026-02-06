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
            font-family: 'Helvetica', 'Arial', sans-serif;
            padding: 50px;
            color: #2d3748;
            line-height: 1.6;
        }

        .header {
            margin-bottom: 40px;
            padding-bottom: 15px;
            border-bottom: 2px solid #000;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #000;
            margin-bottom: 5px;
        }

        .info-section {
            margin-bottom: 35px;
        }

        .info-row {
            margin-bottom: 8px;
            font-size: 11px;
        }

        .info-row .label {
            font-weight: 600;
            display: inline-block;
            width: 120px;
            color: #4a5568;
        }

        .info-row .value {
            color: #2d3748;
        }

        .content-section {
            margin-top: 40px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #000;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .answer-item {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .answer-item .question {
            font-weight: 600;
            font-size: 11px;
            color: #4a5568;
            margin-bottom: 5px;
        }

        .answer-item .answer {
            font-size: 11px;
            color: #2d3748;
            padding-left: 0;
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
        <h1>RELATÓRIO DE SUBMISSÃO</h1>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="label">ID da Submissão:</span>
            <span class="value">#{{ $submission->id }}</span>
        </div>
        <div class="info-row">
            <span class="label">Data:</span>
            <span class="value">{{ \Carbon\Carbon::parse($submission->created_at)->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}</span>
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
