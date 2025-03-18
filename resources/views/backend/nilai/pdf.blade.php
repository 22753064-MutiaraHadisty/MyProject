<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .kop {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .kop img {
            width: 80px;
            height: auto;
            margin-right: 10px;
        }

        .kop-text {
            text-align: center;
            flex: 1;
        }

        .kop-text h1 {
            margin: 0;
            font-size: 20px;
        }

        .kop-text p {
            margin: 5px 0;
            font-size: 14px;
        }

        .line {
            border-bottom: 3px solid black;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
        }

        .subtitle {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-top: -10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .ttd {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="kop">
        <div class="kop-text">
            <h1>PT MICRODATA</h1>
            <p>Jl. Endro Suratmin No.53f, Way Dadi, Kec. Sukarame, Kota Bandar Lampung, Lampung 35131.</p>
            <p>Telp: (021) 12345678 | Email: microdataindonesia@gmail.com</p>
        </div>
    </div>
    <div class="line"></div>

    <h2>Surat Keterangan Nilai Mahasiswa PT MICRODATA</h2>
    <p class="subtitle">Tahun Ajaran 2024/2025</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Nama Guru</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilai as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->student->name }}</td>
                    <td>{{ $item->teacher->name }}</td>
                    <td>{{ $item->mapel->name }}</td>
                    <td>{{ $item->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <p>Bandar Lampung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p><b>Kepala PT MICRODATA</b></p>
        <br><br><br>
        <p><b><u>Nama Kepala</u></b></p>
    </div>
</body>

</html>