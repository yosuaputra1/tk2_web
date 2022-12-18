<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Laravel</title>
    @vite(['resources/js/app.js'])
</head>
<body>
<!-- As a heading -->
<div class="header">
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 fs-1 header-title">GradeCalculator</span>
    </nav>
</div>
<div class="content">
    <h1 class="fs2">Hitung Grade Mahasiswa</h1>
    <p>Masukkan input nilai mahasiswa lalu klik tombol "Hitung" untuk mendapatkan grade mahasiswa beserta grafik
        nilai mahasiswa.
    </p>
    <form method="post">
        @csrf
        <div class="form-group row form-element">
            <label for="nilaiQuiz" class="col-sm-2 element-label">Nilai Quiz</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nilaiQuiz" name="quiz">
            </div>
        </div>
        <div class="form-group row form-element">
            <label for="nilaiTugas" class="col-sm-2 element-label">Nilai Tugas</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nilaiTugas" name="tugas">
            </div>
        </div>
        <div class="form-group row form-element">
            <label for="nilaiAbsensi" class="col-sm-2 element-label">Nilai Absensi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nilaiAbsensi" name="absensi">
            </div>
        </div>
        <div class="form-group row form-element">
            <label for="nilaiPraktek" class="col-sm-2 element-label">Nilai Praktek</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nilaiPraktek" name="praktek">
            </div>
        </div>
        <div class="form-group row form-element element-label">
            <label for="nilaiUAS" class="col-sm-2">Nilai UAS</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nilaiUAS" name="uas">
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-submit">Hitung</button>

    </form>
    @if (!empty($nilai))
    <h1 class="fs3 hasil-hitung">Hasil: </h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Quiz</th>
            <th scope="col">Tugas</th>
            <th scope="col">Absensi</th>
            <th scope="col">Praktek</th>
            <th scope="col">UAS</th>
            <th scope="col">Grade</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$nilai->quiz}}</td>
            <td>{{$nilai->tugas}}</td>
            <td>{{$nilai->absensi}}</td>
            <td>{{$nilai->praktek}}</td>
            <td>{{$nilai->uas}}</td>
            <td>{{$nilai->grade}}</td>
        </tr>
        </tbody>
    </table>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    @endif
</div>
<script>
    const ctx = document.getElementById('myChart');
    var nilai = <?php echo json_encode($nilai); ?>;


    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Quiz', 'Tugas', 'Absensi', 'Praktek', 'UAS'],
            datasets: [{
                label: 'nilai',
                data: [nilai.quiz, nilai.tugas, nilai.absensi, nilai.praktek, nilai.uas],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
