<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Terapi Kognitif</title>
	<link rel="shortcut icon" href="<?= base_url('assets/img1/icon.png')?>">
	<link rel="stylesheet" href="<?= base_url('assets/css1/bootstrap.min.css') ?>" media="all">
	<link rel="stylesheet" href="<?= base_url('assets/css1/mystyle.css') ?>" media="all">
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400&display=swap" rel="stylesheet">
</head>
<body>
	<nav class="navbar bg-dark navbar-dark navbar-expand-lg sticky-top">
		<div class="container px-3">

			<a href="<?= base_url('user') ?>" class="navbar-brand"><img src="<?= base_url('assets/img1/logo1.png') ?>" alt="Logo" title="Logo"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
			</button>

			 <div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="<?= base_url('user') ?>" class="nav-link">Beranda</a></li>
					<li class="nav-item dropdown">
        				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lainnya</a>
        				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item">Masuk sebagai <?= $users['name']; ?></a>
						<div class="dropdown-divider"></div>
          					<a class="dropdown-item" href="<?= base_url('profile') ?>">Akun Saya</a>
          				<div class="dropdown-menu"></div>
						  	<a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Keluar</a>
        				</div>
      				</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" di bawah ini jika anda siap untuk mengakhiri sesi anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>
<body>