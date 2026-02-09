<?php
session_start();

$idx = (int)($_GET['idx'] ?? -1);
$tiketTersedia = $_SESSION['stok'][$idx] ?? 0;

$judul = $_GET['film'] ?? '';
$img   = $_GET['img'] ?? '';
$admin = 2500;

$datapesanan = [];
$total = 0;

if ($tiketTersedia <= 0) {
    echo "<script>
        alert('Maaf tiket sudah habis!');
        window.location.href='index.php';
    </script>";
    exit;
}


if (isset($_POST['hitung']) || isset($_POST['pesan'])) {

    $jam     = $_POST['jam'] ?? '';
    $ruangan = (int)($_POST['ruangan'] ?? 0);
    $tiket   = (int)($_POST['tiket'] ?? 0);
    $payment = $_POST['payment'] ?? '';
    $infoPayment = '';

    $biayaAdmin = $admin * $tiket;
    $total = ($ruangan * $tiket) + $biayaAdmin;

    if ($payment == "gopay") {
        $total += 5000;
        $infoPayment = "Gopay - Rp 5.000";
    } elseif ($payment == "dana") {
        $total += 3000;
        $infoPayment = "Dana - Rp 3.000";
    } elseif ($payment == "shopeepay") {
        $total += 2500;
        $infoPayment = "ShopeePay - Rp 2.500";
    }

    if (isset($_POST['pesan'])) {
        if ($tiket > $tiketTersedia) {
            echo "<script>
                alert('Tiket tidak cukup!');
                window.history.back();
            </script>";
            exit;
        }


        $_SESSION['stok'][$idx] -= $tiket;
        $tiketTersedia = $_SESSION['stok'][$idx];

        $datapesanan = [
            "film"   => $judul,
            "jam"    => $jam,
            "tiketTersedia" => $tiketTersedia,
            "ruangan"=> $ruangan == 150000 ? "VIP" : "Reguler",
            "tiket"  => $tiket,
            "admin"  => $biayaAdmin,
            "total"  => $total,
            "infoPayment" => $infoPayment,
        ];
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Pesan Tiket</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5 border rounded p-4">

<form method="post">
<img src="<?= $img ?>" height="350" class="d-block mx-auto rounded">

<h3 class="text-center mt-4">Pesan Tiket - <?= $judul ?></h3> <br>

<p>Tiket Tersedia: <?= $tiketTersedia ?></p>

<label class="form-label mt-3">Jam Tayang</label><br>
<?php foreach (["12:00","16:00","18:00"] as $j): ?>
<input type="radio" name="jam" value="<?= $j ?>" required
<?= (($_POST['jam'] ?? '') == $j) ? 'checked' : '' ?>> <?= $j ?>
<?php endforeach; ?>

<br><br>

<label class="form-label">Jenis Ruangan</label><br>
<input type="radio" name="ruangan" value="150000" required
<?= (($_POST['ruangan'] ?? '')=="150000")?'checked':'' ?>> VIP - Rp 150.000<br>

<input type="radio" name="ruangan" value="75000"
<?= (($_POST['ruangan'] ?? '')=="75000")?'checked':'' ?>> Reguler - Rp 75.000

<div class="mt-3">
<label class="form-label">Jumlah Tiket</label>
<input type="number" name="tiket" class="form-control" min="1"
value="<?= $_POST['tiket'] ?? '' ?>" required>
</div>

<label class="form-label mt-3">Payment</label>
<select name="payment" class="form-select" required>
<option value="">Pilih Payment</option>
<option value="dana" <?= (($_POST['payment'] ?? '')=='dana')?'selected':'' ?>>Dana - Rp 3.000</option>
<option value="gopay" <?= (($_POST['payment'] ?? '')=='gopay')?'selected':'' ?>>Gopay - Rp 5.000</option>
<option value="shopeepay" <?= (($_POST['payment'] ?? '')=='shopeepay')?'selected':'' ?>>ShopeePay - Rp 2.500</option>
</select>

<br>

<button type="submit" name="hitung" class="btn btn-primary">Hitung</button>

<div class="mt-3">
<label class="form-label">Total</label>
<input type="text" class="form-control" disabled
value="Rp <?= $total ? number_format($total,0,',','.') : '' ?>">
</div>

<button type="submit" name="pesan" class="btn btn-warning mt-3">Pesan</button>

</form>
</div>

<?php if (!empty($datapesanan)): ?>
<script>
alert(`PESANAN BERHASIL!

Film : <?= $datapesanan['film'] ?>

Jam  : <?= $datapesanan['jam'] ?>

Ruang: <?= $datapesanan['ruangan'] ?>

Tiket: <?= $datapesanan['tiket'] ?>

Admin: Rp <?= number_format($datapesanan['admin'],0,',','.') ?>

Payment: <?= $datapesanan['infoPayment'] ?>

TOTAL: Rp <?= number_format($datapesanan['total'],0,',','.') ?>`);

window.location.href = "index.php";
</script>
<?php endif; ?>

</body>
</html>
