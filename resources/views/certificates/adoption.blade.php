<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Adopsi</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.0;
            margin: 0;
            padding: 0;
        }

        .certificate {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 20px solid #ec4899;
            padding: 40px;
            text-align: center;
            position: relative;
            background-color: #fff;
        }

        .header {
            margin-bottom: 30px;
        }

        .title {
            font-size: 36px;
            font-weight: bold;
            color: #ec4899;
            margin: 10px 0;
            text-transform: uppercase;
        }

        .subtitle {
            font-size: 20px;
            margin: 5px 0 20px;
            color: #666;
        }

        .content {
            margin: 30px 0;
            font-size: 18px;
            line-height: 1.0;
        }

        .recipient {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin: 20px 0;
        }

        .cat-details {
            font-size: 18px;
            margin: 20px 0;
        }

        .cat-name {
            font-weight: bold;
            font-size: 24px;
            color: #ec4899;
        }

        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            text-align: center;
            margin: 0 auto;
        }

        .signature-line {
            width: 200px;
            border-bottom: 1px solid #333;
            margin: 50px auto 10px;
        }

        .signature-name {
            font-weight: bold;
        }

        .certificate-id {
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-size: 12px;
            color: #888;
        }

        .issue-date {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 12px;
            color: #888;
        }

        .logo {
            max-width: 150px;
            margin: 0 auto 20px;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="header">
            <img src="{{ public_path('storage/logo.png') }}" alt="Pawtopia Logo" class="logo">
            <h1 class="title">Sertifikat Adopsi</h1>
            <h2 class="subtitle">Pawtopia Cat Adoption Center</h2>
        </div>

        <div class="content">
            <p>Dengan ini menyatakan bahwa:</p>
            <p class="recipient">{{ $adoption->adopter_name }}</p>
            <p>telah secara resmi mengadopsi:</p>
            <p class="cat-name">{{ $cat->name }}</p>

            <div class="cat-details">
                <p>
                    {{ $cat->gender == 'jantan' ? 'Jantan' : 'Betina' }} |
                    {{ $cat->age }} tahun |
                    Ras: {{ $cat->ras ?? 'Kampung' }}
                </p>
            </div>

            <p>Sebagai pemilik yang sah dan bertanggung jawab. Adopsi ini berlaku sejak:</p>
            <p><strong>{{ \Carbon\Carbon::parse($adoption->adopted_at)->format('d F Y') }}</strong></p>
        </div>

        <div class="signature">
            <div class="signature-line"></div>
            <p class="signature-name">Direktur Pawtopia : Octavia Ramadhani</p>
        </div>

        <div class="certificate-id">ID Sertifikat: {{ $certificate_id }}</div>
        <div class="issue-date">Diterbitkan pada: {{ $issue_date }}</div>
    </div>
</body>

</html>