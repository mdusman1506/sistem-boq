<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f0f2f5; padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">

                    {{-- HEADER --}}
                    <tr>
                        <td style="background: linear-gradient(135deg, #4f46e5, #7c3aed); padding: 30px 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; letter-spacing: 1px;">
                                📋 SIM BOQ Enterprise
                            </h1>
                            <p style="color: rgba(255,255,255,0.85); margin: 6px 0 0; font-size: 13px;">
                                Notifikasi Sistem Otomatis
                            </p>
                        </td>
                    </tr>

                    {{-- BODY --}}
                    <tr>
                        <td style="padding: 35px 40px;">
                            <p style="color: #333; font-size: 15px; margin-bottom: 20px;">
                                Halo, <strong>{{ $namaPenerima }}</strong> 👋
                            </p>

                            <p style="color: #555; font-size: 14px; line-height: 1.7; margin-bottom: 20px;">
                                {{ $pesanUtama }}
                            </p>

                            {{-- INFO BOX --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f9ff; border-left: 4px solid #4f46e5; border-radius: 8px; padding: 16px 20px; margin-bottom: 25px;">
                                <tr>
                                    <td>
                                        <p style="margin: 0 0 6px; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">
                                            Nama Proyek
                                        </p>
                                        <p style="margin: 0; font-size: 16px; color: #1a1a2e; font-weight: 700;">
                                            {{ $namaProyek }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            @if($linkAksi)
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding: 5px 0 15px;">
                                        <a href="{{ $linkAksi }}" style="display: inline-block; background: linear-gradient(135deg, #4f46e5, #7c3aed); color: #ffffff; text-decoration: none; padding: 14px 40px; border-radius: 50px; font-size: 14px; font-weight: 600; letter-spacing: 0.5px;">
                                            Buka Dashboard &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            <p style="color: #999; font-size: 12px; margin-top: 20px; line-height: 1.6;">
                                Email ini dikirim secara otomatis oleh sistem. Mohon tidak membalas email ini.
                            </p>
                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px 40px; text-align: center; border-top: 1px solid #e9ecef;">
                            <p style="color: #999; font-size: 11px; margin: 0;">
                                &copy; {{ date('Y') }} SIM BOQ Enterprise — Sistem Informasi Administrasi Proyek
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
