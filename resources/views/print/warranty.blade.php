<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гарантийный Талон • {{ $record->order_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #222;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .box {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 24px;
        }

        .info p {
            margin: 6px 0;
        }

        .info p strong {
            display: inline-block;
            width: 170px;
        }

        .status {
            color: #d32f2f;
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            margin-top: 24px;
            margin-bottom: 10px;
        }

        ul {
            margin: 0;
            padding-left: 18px;
        }

        ul li {
            margin-bottom: 6px;
        }

        .danger-list {
            color: #d32f2f;
            font-weight: 500;
        }

        @media (max-width: 600px) {
            body {
                margin: 16px;
            }

            .title {
                font-size: 20px;
                text-align: center;
            }

            .box {
                padding: 16px;
            }

            .info p strong {
                display: block;
                width: auto;
                margin-bottom: 2px;
            }

            .info p {
                font-size: 14px;
            }

            .date_data {
                flex-direction: column;
                gap: 4px;
            }

            .date_data div {
                width: 100%;
                font-size: 14px;
            }

            .warranty {
                margin-top: 60px;
            }

            .section-title {
                font-size: 15px;
            }

            ul li {
                font-size: 14px;
            }
        }
        .date_data{
            display: flex;
        }
        .date_data div{
            width: 50%;
        }
        .warranty{
            max-width: 1000px;
            margin: 0 auto;
            margin-top: 150px;
        }
    </style>

    <script>
        window.onload = () => {
            window.print();
            window.onafterprint = () => window.close();
        };
    </script>
</head>
<body><div class="date_data">
    <div class="date">{{\Carbon\Carbon::now()->translatedFormat('d F Y, H:i')}}</div>
    <div class="talon"><strong>Kafolat Taloni - </strong> {{ $record->id }}</div>
</div>
<div class="warranty">
    <div class="title">Kafolat Taloni</div>

    <div class="box">
        <div class="info">
            <p><strong>Mahsulot nomi:</strong> {{ $record->product_name }}</p>
            <p><strong>Buyurtma raqami:</strong> {{ $record->order_id }}</p>
            <p><strong>Telefon raqami:</strong> {{ $record->phone_number }}</p>
            <p><strong>Xaridor ismi:</strong> {{ $record->customer_name }}</p>
            <p><strong>Sotib olingan sana:</strong> {{ \Carbon\Carbon::parse($record->bought_date)->translatedFormat('d F Y') }}</p>
            <p><strong>Kafolat tugash sanasi:</strong> {{ \Carbon\Carbon::parse($record->bought_date)->addMonths((int) $record->warranty_period)->translatedFormat('d F Y') }}</p>
            <p><strong>Status:</strong>
                <span class="status">
        {{ \Carbon\Carbon::parse($record->bought_date)->addMonths((int) $record->warranty_period)->isPast()
            ? 'Kafolat muddati tugagan'
            : 'Kafolat amal qiladi'
        }}
    </span>
            </p>
            <p><strong>Izoh:</strong> {{ $record->some_letter }}</p>
        </div>

        <div class="section-title">Kafolat shartlari:</div>
        <ul>
            @foreach($record->warranty_types as $type)
                <li>{{$type}}</li>
            @endforeach
        </ul>

        <div class="section-title">Quyidagi holatlarda kompaniya javobgar emas:</div>
        <ul class="danger-list">
            <li>Agar mijoz o‘zi tomondan suv to‘kib yuborsa</li>
            <li>Metall yoki og‘ir jihozlar bilan pol ustida yurilsa</li>
            <li>Issiq pol (tepliy pol) harorati 35°C dan oshirib yuborilsa</li>
        </ul>
    </div>
</div>
</body>
</html>
