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
            <hr style="border:2px solid black;">
        </div>
        <div class="col-lg-12">
            <h5 class="fw-bold text-center ">FORMULIR</h5>
            <h5 class="fw-bold text-center "><?= $title ?></h5>
            <br>
            <br>
        </div>
        <div class="col-lg-4">

        </div>
        <div class="col-lg-12">
            <style>
                th{
                   padding: 20px;
                }
            </style>
            <table width="100%" >
                <tr>
                    <th width="35%">NAMA PEMOHON</th>
                    <th width="2%">:</th>
                    <th width="63%">..........................................................................................</th>
                </tr>
                <tr >
                    <th width="30%">BARANG</th>
                    <th width="2%">:</th>
                    <th width="68%">..........................................................................................</th>
                </tr>
                <tr >
                    <th width="30%">QUANTITY</th>
                    <th width="2%">:</th>
                    <th width="68%">..........................................................................................</th>
                </tr>
                <tr >
                    <th width="30%">CABANG</th>
                    <th width="2%">:</th>
                    <th width="68%">..........................................................................................</th>
                </tr>
                <tr >
                    <th width="30%">TANGGAL PEMINJAMAN</th>
                    <th width="2%">:</th>
                    <th width="68%">..........................................s/d...............................................</th>
                </tr>
            </table>
            
            <br>
            <br>
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
            <p class="text-center fw-bold">Hartawan Setiawan</p>
            <!-- <p class="text-center">NIP:{{ $kepsek->nip }}</p> -->
        </div>

    </div>
    <script>
        window.print()
    </script>
</body>

</html>
