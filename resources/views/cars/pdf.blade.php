<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Auto Advertentie - {{ $car->license_plate }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #222; line-height: 1.4; margin: 0; padding: 0; }
        .page { padding: 24px; }
        .header { margin-bottom: 24px; }
        .header h1 { margin: 0 0 8px; font-size: 24px; }
        .header p { margin: 0; color: #555; }
        .details { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        .details th, .details td { padding: 10px 12px; border: 1px solid #ddd; text-align: left; }
        .details th { background: #f5f5f5; width: 220px; }
        .price { font-size: 22px; color: #111; font-weight: bold; }
        .note { margin-top: 32px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <h1>Auto Advertentie</h1>
            <p>Kenteken: <strong>{{ $car->license_plate }}</strong></p>
            <p>Gemaakt op: {{ now()->format('d-m-Y') }}</p>
        </div>

        <table class="details">
            <tr>
                <th>Merk</th>
                <td>{{ $car->brand }}</td>
            </tr>
            <tr>
                <th>Model</th>
                <td>{{ $car->model }}</td>
            </tr>
            <tr>
                <th>Prijs</th>
                <td class="price">€ {{ number_format($car->price, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Kilometerstand</th>
                <td>{{ $car->mileage ? number_format($car->mileage, 0, ',', '.') . ' km' : 'Onbekend' }}</td>
            </tr>
            <tr>
                <th>Bouwjaar</th>
                <td>{{ $car->production_year ?? 'Onbekend' }}</td>
            </tr>
            <tr>
                <th>Kleur</th>
                <td>{{ $car->color ?? 'Onbekend' }}</td>
            </tr>
            <tr>
                <th>Aangeboden door</th>
                <td>{{ $car->user?->name ?? 'Onbekend' }}</td>
            </tr>
            <tr>
                <th>Geplaatst op</th>
                <td>{{ $car->created_at?->format('d-m-Y') ?? 'Onbekend' }}</td>
            </tr>
        </table>

        <p class="note">Printervriendelijke PDF met alle benodigde gegevens om in de auto te plaatsen.</p>
    </div>
</body>
</html>
