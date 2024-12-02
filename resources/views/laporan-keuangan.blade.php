<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan</title>
</head>
<body>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Catatan Pemasukan Himatif</h5>
                        <p class="card-text text-muted">
                            Pemasukan selama satu tahun kepengurusan. Akan dipertanggungjawabkan pada Musyawarah Besar.
                        </p>

                        {{-- Tombol Cetak --}}
                        <button type="button" class="btn btn-info" onclick="showPrintArea()">
                            <i class="bi bi-printer"></i> Cetak
                        </button>

                        <!-- Div untuk tampilkan laporan setelah tombol cetak diklik -->
                        <div id="printableArea" style="display:none; margin-top: 20px;">
                            <title>Laporan Keuangan</title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    line-height: 1.5;
                                    margin: 40px;
                                }

                                .header,
                                .footer {
                                    text-align: center;
                                    margin-bottom: 20px;
                                }

                                .content {
                                    margin-top: 20px;
                                }

                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                    margin-top: 20px;
                                }

                                th,
                                td {
                                    border: 1px solid black;
                                    padding: 10px;
                                    text-align: left;
                                }

                                th {
                                    background-color: #f4f4f4;
                                }
                            </style>

                            <body>
                                <div class="header">
                                    <h2>Laporan Keuangan Tahun 2024</h2>
                                    <p>Organisasi/Perusahaan XYZ</p>
                                </div>

                                <div class="content">
                                    <h3>Ringkasan Keuangan</h3>
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
                                    </table>
                                </div>

                                <div class="footer">
                                    <p>Disusun pada: {{ now()->format('d-m-Y') }}</p>
                                    <p><strong>Ketua</strong></p>
                                    <br><br>
                                    <p>________________________</p>
                                </div>
                            </body>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function showPrintArea() {
            // Menampilkan area untuk dicetak
            document.getElementById('printableArea').style.display = 'block';
            
            // Memulai proses cetak setelah menampilkan konten
            window.print();
            
            // Setelah pencetakan selesai, sembunyikan kembali area cetak
            document.getElementById('printableArea').style.display = 'none';
        }
    </script>
</body>
</html>
    
