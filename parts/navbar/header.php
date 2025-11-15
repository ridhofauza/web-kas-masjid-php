<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <span class="logo-lg"><b>Kas</b> Masjid</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- /.messages-menu -->

                <!-- Notifications Menu -->

                <!-- Tasks Menu -->

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= !empty($_SESSION['foto_profil']) ? $_SESSION['foto_profil'] : 'dist/img/default.jpg' ?>"
                            class="user-image" alt="User Image">
                        <span class="hidden-xs"><?=$_SESSION['nama']?></span>
                    </a>
                    <ul class="dropdown-menu" style="
                        background-color: #fff; 
                        border-radius: 8px; 
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
                        overflow: hidden; 
                        padding: 20px;
                        width: 300px;
                        text-align: center;
                        position: absolute;
                        right: 0;
                        left: auto;">

                        <!-- User image and info -->
                        <li style="
                            margin-bottom: 15px;">
                            <img src="<?= !empty($_SESSION['foto_profil']) ? $_SESSION['foto_profil'] : 'dist/img/default.jpg' ?>"
                                alt="User Image" style="
                                width: 100px; 
                                height: 100px; 
                                border-radius: 50%; 
                                border: 3px solid #ddd;">
                            <p style="
                                margin-top: 10px; 
                                font-size: 18px; 
                                font-weight: bold; 
                                color: #333;">
                                <?=$_SESSION['nama']?>
                            </p>
                            <p style="
                                font-size: 14px; 
                                color: #777;">
                                <?= ucfirst($_SESSION['role']) ?> - KMSH
                            </p>
                        </li>

                        <!-- Logout Button -->
                        <li>
                            <a href="logout.php" class="btn btn-danger btn-block" style="
                                border-radius: 5px; 
                                padding: 10px; 
                                font-size: 16px;
                                color: #fff;
                                background-color: #e74c3c;
                                border-color: #e74c3c;">
                                Keluar
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<style>
/* Media query untuk layar kecil */
@media (max-width: 768px) {
    .navbar-custom-menu .dropdown-menu {
        width: auto !important;
        /* Lebar otomatis */
        left: auto !important;
        /* Reset posisi kiri */
        right: 0 !important;
        /* Posisi kanan tetap */
    }

    .navbar-custom-menu .user-header {
        font-size: 16px !important;
        /* Ukuran font lebih kecil */
    }

    .navbar-custom-menu .user-image {
        width: 100% !important;
        /* Ukuran gambar lebih kecil */
        /* height: 70px !important; */
    }

    .navbar-custom-menu .btn {
        font-size: 14px !important;
        /* Ukuran font tombol lebih kecil */
    }
}
</style>