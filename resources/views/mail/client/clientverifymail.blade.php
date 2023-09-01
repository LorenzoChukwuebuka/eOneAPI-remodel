<html>
    <body style="font-family: Arial, sans-serif;">
        <h2>Hi {{ $mailData['businessname'] }},</h2>
        <p>Thank you for registering with our service. Please use the following One-Time Password (OTP) to verify your email address and complete your account setup:</p>
        <h3>OTP: {{ $mailData['token'] }}</h3>
        <p>Please note that this OTP can only be used once and is valid for a limited time.</p>
        <p>If you did not attempt to register with our service, please ignore this email.</p>
        <br>
        <p>Regards,<br> {{ config('app.name') }} </p>
    </body>
</html>
