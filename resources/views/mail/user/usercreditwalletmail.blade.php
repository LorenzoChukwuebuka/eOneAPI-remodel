<html>
    <body style="font-family: Arial, sans-serif;">
        <h2>Hi {{ $mailData['username'] }},</h2>
        <p>Please note that your wallet has been topped up with:</p>
        <h3>amount: {{ $mailData['amount'] }}</h3>
        <p> Thank you for choosing {{config('app.name')}} </p>
        <br>
        <p>Regards,<br> {{ config('app.name') }} </p>
    </body>
</html>
