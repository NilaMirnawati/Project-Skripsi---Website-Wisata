<?php
session_start();
include 'controller/koneksi.php';
if (isset($_SESSION['sukses'])) {
    echo "<script>alert('" . $_SESSION['sukses'] . "');</script>";
    unset($_SESSION['sukses']);
}
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
}
if (isset($_GET['snaptoken']) && !empty($_GET['snaptoken'])) {
    $snaptoken = $conn->real_escape_string($_GET['snaptoken']);
}
if (isset($_GET['id_tiket']) && !empty($_GET['id_tiket'])) {
    $id_tiket = $conn->real_escape_string($_GET['id_tiket']);
    $sql2 = "SELECT * FROM tiket where id = $id_tiket";
    $result2 = mysqli_query($conn, $sql2);
    $tiket = mysqli_fetch_assoc($result2);
    // var_dump($tiket);
}

$sql = "SELECT * FROM wisata where id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

$iduser = $_SESSION['user_id'];
$sql3 = "SELECT username FROM user where id = $iduser";
$result3 = mysqli_query($conn, $sql3);
$user = mysqli_fetch_assoc($result3);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tiket | Tuban Explore</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <header class="navbar sticky-top navbar-expand-lg navbar-light shadow-sm main-nav">
        <div class="col-md-12 my-lg-2">
            <div class="card sticky-lg-top">
                <div class="card-body">
                    <form action="controller/tiket.php" id="payment-form" method="post">
                        <div>
                            <h5 class="font-weight-bold text-center mb-4">Form Pembelian Tiket Wisata</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>
                                        <span id="named" class="">Nama Lengkap</span>
                                        <span class="text-danger font-weight-bold">*</span>
                                    </label>
                                    <input type="hidden" name="id_user" id="" value="<?php echo $_SESSION['user_id'] ?>">
                                    <input type="text" name="name" id="name" value="<?php echo isset($tiket['nama_user']) ?  $tiket['nama_user'] : $user['username']; ?>" class="form-control" require>
                                    <input type="hidden" name="id_tiket" id="id_tiket" value="<?php echo isset($tiket['id']) ? $tiket['id'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>
                                        <span id="phoneID" class="">No. Telepon</span>
                                        <span class="text-danger font-weight-bold">*</span>
                                    </label>
                                    <input type="text" name="phone" id="phone" value="<?php echo isset($tiket['no_telp']) ? $tiket['no_telp'] : ''; ?>" class="form-control " required>
                                </div>
                                <div class="form-row">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>
                                        <span id="jadwal_keberangkatan" class="">Tanggal Kunjungan</span>
                                        <span class="text-danger font-weight-bold">*</span>
                                    </label>
                                    <input type="date" name="tanggal" id="tanggal" value="<?php echo isset($tiket['tanggal']) ? $tiket['tanggal'] : ''; ?>" class="form-control " required="">
                                </div>
                                <div class="form-row">
                                </div>
                                <div class="form-group">
                                    <label>
                                        <span id="paymentmethodID" class="">Metode Pembayaran</span>
                                        <span class="text-danger font-weight-bold">*</span>
                                    </label>
                                    <div class="row">
                                        <div class="col-md-6 mb-md-0 mb-2 text-center">
                                            <p class="small mb-0 mt-2">Transfer dengan m-Banking/e-Wallet</p>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="my-4">
                                    </div>
                                    <div id="price-summary">
                                        <div class="row align-items-center">
                                            <div class="col-md-12 my-1">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Nama Wisata</th>
                                                                <th>Harga Tiket</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $data['id'] ?>
                                                                    <input type="hidden" name="id_wisata" id="" value=" <?php echo isset($tiket['id_wisata']) ? $tiket['id_wisata'] : $data['id']; ?>">
                                                                    
                                                                </td>
                                                                <td>
                                                                    <?php echo $data['nama'] ?>
                                                                    <input type="hidden" name="nama_wisata" id="" value="<?php echo isset($tiket['nama_wisata']) ? $tiket['nama_wisata'] : $data['nama']; ?>">
                                                                </td>
                                                                <td>
                                                                    Rp. <?php echo number_format($data['htm'], 0, ',', '.') ?>
                                                                    <input type="hidden" name="harga" id="harga" size="10" value="<?php echo isset($tiket['harga']) ? $tiket['harga'] : $data['htm']; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="jumlah" id="jumlah" value="<?php echo isset($tiket['jumlah']) ? $tiket['jumlah'] : 0; ?>" onchange="hitungTotal()">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" style="text-align: right;">Jumlah Total</td>
                                                                <td>
                                                                    <input type="text" name="total" id="Total" value="<?php echo isset($tiket['total']) ? $tiket['total'] : ''; ?>" readonly>
                                                                </td>
                                                            </tr>
                                                    </table>
                                                    <br>
                                                </div>

                                            </div>
                                            </thead>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($snaptoken)) { ?>
                        <button id="pay-button" class="btn btn-main"> Lanjutkan</button>
                        
                    <?php } else { ?>
                        <form action="controller/token.php" method="post">
                            <input type="hidden" name="t_id_user" id="t_id_user" value="<?php echo $_SESSION['user_id'] ?>">
                            <input type="hidden" name="t_user" id="t_user">
                            <input type="hidden" name="t_telp" id="t_telp">
                            <input type="hidden" name="t_tanggal" id="t_tanggal">
                            <input type="hidden" name="t_id_wisata" id="t_id_wisata" value="<?php echo $data['id'] ?>">
                            <input type="hidden" name="t_wisata" id="t_wisata" value="<?php echo $data['nama'] ?>">
                            <input type="hidden" name="t_harga" id="t_harga" value="<?php echo $data['htm'] ?>">
                            <input type="hidden" name="t_jumlah" id="t_jumlah">
                            <input type="hidden" name="t_total" id="t_total">
                            <div class="py-3 text-center">
                                <div>
                                    <button type="submit" class="btn btn-main" value="submit" style="width: 200px;">
                                        <span id="btntextID">
                                            <i class="fa fa-fw fa-clipboard-list"></i>Beli Tiket</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <script type="text/javascript">
            function hitungTotal() {
                var harga = parseInt(document.getElementById("harga").value) || 0;
                var jumlah = parseInt(document.getElementById("jumlah").value) || 0;
                var jumlahTotal = harga * jumlah;
                document.getElementById("Total").value = jumlahTotal;
                document.getElementById("t_jumlah").value = jumlah;
                document.getElementById("t_total").value = jumlahTotal;
                var name = document.getElementById("name").value;
                document.getElementById("t_user").value = name;
                var telp = document.getElementById("phone").value;
                document.getElementById("t_telp").value = telp;
                var tanggal = document.getElementById("tanggal").value;
                document.getElementById("t_tanggal").value = tanggal;

            }
        </script>
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-KPrhjeMuQtxGFXER"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                snap.pay('<?php echo $snaptoken; ?>', {
                    onSuccess: function(result) {
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        $("#payment-form").submit();
                    }
                });
            };
        </script>