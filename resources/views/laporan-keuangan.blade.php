<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan Himpunan Teknik Informatika Tahun 2024</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        header {
            text-align: center;
            position: relative;
            margin-bottom: 20px;
        }
        .logo-left {
            position: absolute;
            top: 0;
            left: 0;
            height: 120px;
        }
        .logo-right {
            position: absolute;
            top: 0;
            right: 0;
            height: 80px;
        }
        .kop-text {
            text-align: center;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .footer {
            text-align: right;
            margin-top: 20px;
        }
        .signature {
            margin-top: 100px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <div class="kop">
            <img class="logo-left" src="{{ asset('assets/img/logo-unib.png') }}" alt="Logo UNIB" style="height: 80px;">
            <img class="logo-right" src="{{ asset('assets/img/logo-himatif.png') }}" alt="Logo ERCOM" style="height: 80px;">
            <h3 style="margin-bottom: 0%">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI<br>
                UNIVERSITAS BENGKULU<br>
                FAKULTAS TEKNIK<br>
                HIMPUNAN MAHASISWA TEKNIK INFORMATIKA</h3>
            <p style="margin-top: 0%">Sekretariat: Gedung Kesekretariatan Himpunan dan UKM FT KBM UNIB, Kota Bengkulu</p>
        </div>
        <hr style="border: 1px solid black; ">
        <h3 style="text-align: center;">LAPORAN KEUANGAN HIMPUNAN MAHASISWA TEKNIK INFORMATIKA</h3>
    </header>
    <div class="content">
        <h3>Catatan Pengeluaran Selama Satu Tahun Kepengurusan Himatif</h3>
        <h3>Kepengurusan Tahun 2023/2024</h3>
        <table>
            <tr>
                <th>Keterangan</th>
                <th>Nominal (Rp)</th>
            </tr>
            <tr>
                <td>Total Pemasukan</td>
                <td>{{ number_format($totalPemasukan, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Pengeluaran</td>
                <td>{{ number_format($totalPengeluaran, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kas Anggota</td>
                <td>{{ number_format($totalKasAnggota, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Saldo Akhir</strong></td>
                <td><strong>{{ number_format(($totalPemasukan + $totalKasAnggota) - $totalPengeluaran, 2, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Mengetahui</p>
        <p>Kepala Bagian Administrasi dan Keuangan</p>
        <br><br>
        <p><strong>Rana Qonitah Helida</strong></p>
        <p><strong>NPM: G1A022017</strong></p>
    </div>

    <script>
        window.onload = () => {
            window.print(); // Otomatis mencetak saat halaman dimuat
        };
    </script>
</body>
</html>
