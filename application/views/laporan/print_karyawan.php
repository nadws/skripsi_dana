<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title ?></title>
</head>

<body>



    <div class="row justify-content-center">
        <div class="col-lg-12 mt-4">
            <h5 class="fw-bold text-center">PT.SABA INDOMEDICA</h5>
        </div>
        <div class="col-lg-12">
            <h5 class="fw-bold text-center">TAHUN 2023/2024</h5>
        </div>

        <div class="col-lg-12">
            <hr style="border:2px solid black;">
        </div>
        <div class="col-lg-12">
            <h5 class="fw-bold text-center "><?= $title ?></h5>
            <br>
            <br>
        </div>
        <div class="col-lg-4">

        </div>
        <div class="col-lg-12">
            <!-- <p>Kelas : {{ $nm_kelas }}</p> -->
            <table id="example2" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>NIK</th>
                                          <th>Nama</th>
                                          <th>Posisi</th>
                                          <th>Tanggal lahir</th>
                                          <th>Jenis Kelamin</th>
                                          <th>Lama Bekerja</th>
                                          <th>Departemen</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($karyawan as $no => $c) : ?>
                                          <tr>
                                              <td><?= $no + 1 ?></td>
                                              <td><?= $c->nik ?></td>
                                              <td><?= $c->nm_karyawan ?></td>
                                              <td><?= $c->nm_level ?></td>
                                              <td><?= date('d-m-Y', strtotime($c->tgl_lahir))  ?></td>
                                              <td><?= $c->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                              <td>
                                                  <?php $lahir    = new DateTime($c->tgl_bergabung);
                                                    $today        = new DateTime();
                                                    $umur = $today->diff($lahir);
                                                    echo $umur->y;
                                                    echo " Tahun ";
                                                    ?>
                                              </td>
                                              <td><?= $c->nama_departemen ?></td>
                                          </tr>
                                      <?php endforeach ?>
                                  </tbody>
                              </table>

        </div>
        <div class="col-lg-6 col-6">
        </div>
        <div class="col-lg-6 col-6">
            <p class="text-center">Banjarmasin, <?= date('d F Y') ?></p>
        </div>
        <div class="col-lg-6 col-6">
        </div>
        <div class="col-6">
            <p class="text-center">Mengetahui,</p>
            <p class="text-center ">Direktur PT.Saba Indomedica Banjarmasin,</p>
            <br>
            <br>
            <br>
            <p class="text-center"><u class="fw-bold text-center">Hartawan Setiawan</u></p>
            <!-- <p class="text-center">NIP:{{ $kepsek->nip }}</p> -->
        </div>

    </div>


    <!-- Optional JavaScript; choose one of the two! -->
    <script>
        window.print()
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
