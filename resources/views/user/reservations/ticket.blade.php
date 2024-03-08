<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .event-details {
            background: linear-gradient(145deg, #ffffff, #e6e9ed);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }
        img.qr-code {
            margin-top: 20px;
            width: 450px;
            height: 450px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .highlight {
            background-color: #ffefba;
            padding: 2px 4px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="event-details">
    <h1>{{ $event->title }}</h1>
    <p><strong>Date:</strong> <span class="highlight">{{ $event->date->format('F d, Y H:i') }}</span></p>
    <p><strong>Location:</strong> <span class="highlight">{{ $event->location }}</span></p>
    <p><strong>Price:</strong> <span class="highlight">${{ number_format($event->price, 2) }}</span></p>
    <p><strong>Unique ID:</strong> <span class="highlight">{{ $ticket->ticket_unique_id }}</span></p>
    <img src="{{ $ticket->qr_url }}" class="qr-code" alt="QR Code">
</div>
</body>
</html>
