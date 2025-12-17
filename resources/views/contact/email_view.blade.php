<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>

<body style="margin:0; padding:0; background-color:#f3f4f6; font-family:Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:30px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#4f46e5; padding:20px; text-align:center;">
                            <h2 style="color:#ffffff; margin:0;">New Contact Request</h2>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px; color:#374151;">
                            <p style="font-size:16px; margin-bottom:20px;">
                                You have received a new message from your website contact form.
                            </p>

                            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
                                <tr>
                                    <td style="font-weight:bold; width:120px;">Name:</td>
                                    <td>{{ $name }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">Email:</td>
                                    <td>{{ $email }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold; vertical-align:top;">Message:</td>
                                    <td style="white-space:pre-line;">{{ $messages }}</td>
                                </tr>
                            </table>

                            <hr style="margin:30px 0; border:none; border-top:1px solid #e5e7eb;">

                            <p style="font-size:14px; color:#6b7280;">
                                This email was automatically generated from the Contact Us page.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb; padding:15px; text-align:center; font-size:13px; color:#6b7280;">
                            © {{ date('Y') }} Your Calculator Website
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>