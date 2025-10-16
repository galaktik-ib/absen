<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Hadir Dosen & Asisten</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; text-align: center; padding: 5px; }
        .no-border { border: none; }
        .title { text-align: center; font-weight: bold; }
    </style>
</head>
<body>

    <div @class(['title'])>
        <p>DAFTAR HADIR DOSEN DAN ASISTEN LABORATORIUM KOMPUTER</p>
        <p>STMIK INDONESIA BANJARMASIN</p>
        <p>{{ strtoupper($bulan->translatedFormat('F Y')) }}</p>
    </div>

    <table @class(['no-border']) style="margin-top:20px;">
        <tr>
            <td @class(['no-border']) width="20%">Laboratorium</td>
            <td @class(['no-border'])>: {{ $matkulKelas->lab }}</td>
            <td @class(['no-border']) width="20%">Mata Kuliah</td>
            <td @class(['no-border'])>: {{ $matkulKelas->matkul->nama_matkul }}</td>
        </tr>
        <tr>
            <td @class(['no-border'])>Dosen</td>
            <td @class(['no-border'])>: {{ $matkulKelas->dosen->nama_dosen }}</td>
            <td @class(['no-border'])>Kelas</td>
            <td @class(['no-border'])>: {{ $matkulKelas->kelas->nama_kelas }}</td>
        </tr>
        <tr>
            <td @class(['no-border'])>Hari</td>
            <td @class(['no-border'])>: {{ $matkulKelas->hari }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                @foreach ($tanggalKuliah as $tgl)
                    <th>{{ $tgl->translatedFormat('j M') }}</th>
                @endforeach
                <th>Keterangan</th>
                <th>Wajib</th>
                <th>Hadir</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Dosen<br>{{ $matkulKelas->dosen->nama_dosen }}</td>
                @foreach ($tanggalKuliah as $tgl)
                    <td></td>
                @endforeach
                <td></td>
                <td>{{ count($tanggalKuliah) }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Asisten 1<br>{{ $matkulKelas->asisten->nama_asisten }}</td>
                @foreach ($tanggalKuliah as $tgl)
                    <td></td>
                @endforeach
                <td></td>
                <td>{{ count($tanggalKuliah) }}</td>
                <td></td>
            </tr>

            <tr>
                <td>Asisten 2<br>{{ $matkulKelas->asisten2->nama_asisten ?? '-' }}</td>
                @foreach ($tanggalKuliah as $tgl)
                    <td></td>
                @endforeach
                <td></td>
                <td>{{ count($tanggalKuliah) }}</td>
                <td></td>
            </tr>

        </tbody>
    </table>

    <div style="margin-top:40px; text-align:right;">
        <p>Kepala {{ $matkulKelas->lab }}</p><br><br>
        <p><strong>Herman Rizani, S.Kom.</strong><br>NIK 01.1109.044</p>
    </div>

</body>
</html>
