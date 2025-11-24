<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card border-success">
            <div class="card-header bg-success text-white">
                <h1>📅 Kalender Akademik</h1>
            </div>
            <div class="card-body">
                <p class="lead">Jadwal kegiatan perkuliahan semester ini.</p>
                
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1 Agustus</td>
                            <td>Awal Perkuliahan</td>
                        </tr>
                        <tr>
                            <td>20 Oktober</td>
                            <td>Ujian Tengah Semester (UTS)</td>
                        </tr>
                    </tbody>
                </table>
                
                <a href="{{ url('/') }}" class="btn btn-secondary">Kembali ke Home</a>
            </div>
        </div>
    </div>
</body>
</html>