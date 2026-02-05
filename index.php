<?php 

$daftarFilm = [
    ["Avanger: Endgame", "https://i.pinimg.com/1200x/95/26/68/9526684fe11e38cf6bb6fbd48e37de6a.jpg"],
    ["Spider-Man: No Way Home", "https://i.pinimg.com/1200x/6c/3c/e2/6c3ce2cd84134fb3d4bafb82f4f44834.jpg"],
    ["The Batman", "https://i.pinimg.com/736x/51/26/08/512608d675fd98fca4105f90ab7d6d5c.jpg"]
]

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bioskop Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Bioskop Modern</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Lihat Film</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="https://i.pinimg.com/1200x/45/2c/b2/452cb28a95ecf1b11774b28b2b3c4be1.jpg"  class="d-block w-100" height="800px" alt="...">
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
            <h5>Selamat datang di Bioskop Modern</h5>
            <p>Tempat terbaik untuk menikmati film favorit anda</p>
            <a href=""><button type="button" class="btn btn-warning">Lihat Film</button></a>
        </div>
        </div>
    </div>
    </div>


    <center><h4 style="margin-top: 50px;">Daftar Film</h4></center>


    <div class="container p-5">
        <div class="row row-cols-1 row-cols-md-3 g-4 ">
        <?php foreach ($daftarFilm as $daftarFilms => $tampil) {?>
        <div class="col">
            <div class="card h-100">
            <img src="<?=  $tampil[1] ?>" height="500px" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $tampil[0] ?></h5>
                <a href="pesan.php?film=<?= urlencode($tampil[0]) ?>&img=<?= urlencode($tampil[1]) ?>"><button type="button" class="btn btn-warning">Pesan Tiket</button></a>
            </div>
            </div>
        </div>
        <?php } ?>
        </div>
    </div>



    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>