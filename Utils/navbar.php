<!-- Vertical Navbar -->
<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="/home">
                <h3 class="text-primary"><img src="./../Assets/images/Blue White Minimalist Initial Academy Logo.png" width="40"><span class="text-dark">You</span>Demy</h3> 
            </a>
            <!-- User menu (mobile) -->
            <div class="navbar-user d-lg-none">
                <!-- Dropdown -->
                <div class="dropdown">
                    <!-- Toggle -->
                    <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-parent-child">
                            <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle">
                            <span class="avatar-child avatar-badge bg-success"></span>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/AdminStatistics" class="nav-link" href="adminBord.php">
                            <i class="bi bi-house"></i> Statistiques
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="/AdminCours" class="nav-link" href="adminLivres.php">
                        <i class="bi bi-file-text"></i> Cours
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/AdminBordCateg" class="nav-link" href="adminCategories.php">
                            <i class="bi bi-globe-americas"></i> Catégories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/AdminBordTag" class="nav-link" href="adminTags.php">
                        <i class="bi bi-person-square"></i> Tags
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/AdminUsers" class="nav-link" href="adminUser.php">
                            <i class="bi bi-people"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link" href="#">
                            <i class="bi bi-box-arrow-left"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>