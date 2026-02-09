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
            color: #e2e8f0;
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
        <h1>Relatório de Submissão</h1>
        <div class="divider"></div>
        <div class="subtitle">Submissão #{{ $submission->id }} &mdash; {{ \Carbon\Carbon::parse($submission->created_at)->setTimezone('America/Sao_Paulo')->format('d/m/Y') }}</div>
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
