<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $subject ?? 'Informatics Care' }}</title>
    <!--[if mso]>
    <style type="text/css">
        body, table, td {font-family: Arial, sans-serif !important;}
    </style>
    <![endif]-->
</head>
<body style="margin: 0; padding: 0; background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0c4a6e 100%);">
        <tr>
            <td align="center" style="padding: 40px 20px;">
                <!-- Email Container -->
                <table role="presentation" style="max-width: 600px; width: 100%; border-collapse: collapse; background: #1e293b; border-radius: 16px; border: 1px solid rgba(59, 130, 246, 0.3); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5); overflow: hidden;">
                    <!-- Header with Tech Pattern -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e3a8a 0%, #0c4a6e 100%); padding: 40px 30px; text-align: center; border-bottom: 1px solid rgba(59, 130, 246, 0.3);">
                            <!-- Logo/Icon -->
                            <div style="width: 64px; height: 64px; margin: 0 auto 20px; background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4);">
                                <span style="color: #ffffff; font-size: 32px; font-weight: bold;">⚡</span>
                            </div>
                            <h1 style="margin: 0; color: #e0e7ff; font-size: 28px; font-weight: 700; background: linear-gradient(135deg, #60a5fa 0%, #34d399 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                Informatics Care
                            </h1>
                            <p style="margin: 8px 0 0; color: #94a3b8; font-size: 14px; font-family: 'Courier New', monospace; letter-spacing: 2px;">
                                PLATFORM PELAPORAN TERPADU
                            </p>
                        </td>
                    </tr>

                    <!-- Content Area -->
                    <tr>
                        <td style="padding: 40px 30px; background: #1e293b;">
                            <!-- Greeting -->
                            @if (! empty($greeting))
                                <h2 style="margin: 0 0 24px; color: #e0e7ff; font-size: 24px; font-weight: 600;">
                                    {{ $greeting }}
                                </h2>
                            @else
                                @if ($level === 'error')
                                    <h2 style="margin: 0 0 24px; color: #f87171; font-size: 24px; font-weight: 600;">
                                        @lang('Whoops!')
                                    </h2>
                                @else
                                    <h2 style="margin: 0 0 24px; color: #60a5fa; font-size: 24px; font-weight: 600;">
                                        @lang('Hello!')
                                    </h2>
                                @endif
                            @endif

                            <!-- Intro Lines -->
                            @foreach ($introLines as $line)
                                <p style="margin: 0 0 16px; color: #cbd5e1; font-size: 16px; line-height: 1.6;">
                                    {{ $line }}
                                </p>
                            @endforeach

                            <!-- Action Button -->
                            @isset($actionText)
                                <table role="presentation" style="width: 100%; margin: 32px 0; border-collapse: collapse;">
                                    <tr>
                                        <td align="center" style="padding: 0;">
                                            <a href="{{ $actionUrl }}" style="display: inline-block; padding: 16px 32px; background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%); color: #ffffff; text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 16px; box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4); transition: all 0.3s ease;">
                                                {{ $actionText }}
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            @endisset

                            <!-- Outro Lines -->
                            @foreach ($outroLines as $line)
                                <p style="margin: 24px 0 0; color: #cbd5e1; font-size: 16px; line-height: 1.6;">
                                    {{ $line }}
                                </p>
                            @endforeach

                            <!-- Subcopy (Link fallback) -->
                            @isset($actionText)
                                <table role="presentation" style="width: 100%; margin-top: 24px; padding-top: 24px; border-top: 1px solid rgba(100, 116, 139, 0.3);">
                                    <tr>
                                        <td>
                                            <p style="margin: 0 0 12px; color: #94a3b8; font-size: 14px; line-height: 1.5;">
                                                @lang(
                                                    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below into your web browser:",
                                                    ['actionText' => $actionText]
                                                )
                                            </p>
                                            <p style="margin: 0; padding: 12px; background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; word-break: break-all;">
                                                <a href="{{ $actionUrl }}" style="color: #60a5fa; text-decoration: none; font-family: 'Courier New', monospace; font-size: 12px;">
                                                    {{ $displayableActionUrl }}
                                                </a>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            @endisset
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 30px; background: #0f172a; border-top: 1px solid rgba(59, 130, 246, 0.3); text-align: center;">
                            @if (! empty($salutation))
                                <p style="margin: 0 0 12px; color: #94a3b8; font-size: 14px;">
                                    {{ $salutation }}
                                </p>
                            @else
                                <p style="margin: 0 0 12px; color: #94a3b8; font-size: 14px;">
                                    @lang('Regards,')<br>
                                    <strong style="color: #60a5fa;">{{ config('app.name') }}</strong>
                                </p>
                            @endif

                            <p style="margin: 16px 0 0; color: #64748b; font-size: 12px; font-family: 'Courier New', monospace;">
                                © {{ date('Y') }} Informatics Care - Universitas Malikussaleh
                            </p>
                            <p style="margin: 8px 0 0; color: #475569; font-size: 11px; font-family: 'Courier New', monospace;">
                                Powered by Next-Gen Technology
                            </p>
                        </td>
                    </tr>
                </table>

                <!-- Footer Note -->
                <table role="presentation" style="max-width: 600px; width: 100%; margin-top: 20px; border-collapse: collapse;">
                    <tr>
                        <td style="text-align: center; padding: 20px;">
                            <p style="margin: 0; color: #64748b; font-size: 12px;">
                                Email ini dikirim secara otomatis dari sistem Informatics Care.<br>
                                Jangan balas email ini.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
