<?php
include 'conn.php';

$profileResult = mysqli_query($conn, "SELECT id, nama, tagline, deskripsi FROM profile LIMIT 1");
$profile = mysqli_fetch_assoc($profileResult);

$skillsResult = mysqli_query($conn, "SELECT * FROM skills");
$skills = [];
while ($row = mysqli_fetch_assoc($skillsResult)) {
    $skills[] = $row;
}

$pengalamanResult = mysqli_query($conn, "SELECT * FROM pengalaman");
$pengalaman = [];
while ($row = mysqli_fetch_assoc($pengalamanResult)) {
    $pengalaman[] = $row;
}

$certResult = mysqli_query($conn, "SELECT id, judul, penerbit FROM certificates");
$certificates = [];
while ($row = mysqli_fetch_assoc($certResult)) {
    $certificates[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - <?= htmlspecialchars($profile['nama']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Portofolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#certificates">Certificates</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-white">
                    <h5>Halo, Saya</h5>
                    <h1 class="fw-bold"><?= htmlspecialchars($profile['nama']) ?></h1>
                    <p><?= htmlspecialchars($profile['tagline']) ?></p>
                    <a href="#about" class="btn btn-primary">Tentang Saya</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="gambar.php?type=profile&id=<?= $profile['id'] ?>"
                        alt="Profile"
                        class="img-fluid rounded-circle profile-img">
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about-section d-flex align-items-center">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">About Me</h2>
            <div class="row">
                <div class="col-lg-7">
                    <p><?= htmlspecialchars($profile['deskripsi']) ?></p>
                    <h5 class="mt-4">Pengalaman</h5>
                    <ul>
                        <?php foreach ($pengalaman as $item): ?>
                            <li><?= htmlspecialchars($item['deskripsi']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <h5 class="mb-3">Skills</h5>
                    <?php foreach ($skills as $skill): ?>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span><?= htmlspecialchars($skill['nama']) ?></span>
                                <span><?= (int)$skill['level'] ?>%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary"
                                    role="progressbar"
                                    style="width: <?= (int)$skill['level'] ?>%"
                                    aria-valuenow="<?= (int)$skill['level'] ?>"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="certificates" class="certificates-section d-flex align-items-center">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Certificates</h2>
            <div class="row">
                <?php foreach ($certificates as $cert): ?>
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="gambar.php?type=cert&id=<?= $cert['id'] ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($cert['judul']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($cert['judul']) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($cert['penerbit']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <footer class="footer text-white text-center py-4">
        <p class="mb-1"><?= htmlspecialchars($profile['nama']) ?> &copy; <?= date('Y') ?></p>
        <p class="mb-0">Sistem Informasi Universitas Mulawarman</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php
include 'conn.php';
