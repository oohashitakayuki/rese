<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>リマインドメール</title>
</head>

<body>
  <h3>{{ $reservation->user->name }} さん</h3>
  <p>本日、{{ $reservation->shop->name }}にてご予約いただいております。</p>
  <p>予約内容をご確認ください。</p>
  <p>予約日: {{$reservation->date }}</p>
  <p>時間: {{ $reservation->time }}</p>
  <p>人数: {{ $reservation->number }}</p>
</body>
</html>