<!DOCTYPE html>
<html>
<head>
    <title>Laravel Dompdf Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <div class="title">{{ $title }}</div>
    <div class="content">
        <p>This is a sample PDF generated using Dompdf in Laravel.</p>
        <p>Date: {{ $date }}</p>
        <img src="{{ $signaturePath }}" alt="Signature">
    </div>
</body>
</html>
