<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="btn btn-sm btn-light me-3" id="toggleSidebar"><i
                    class="fas fa-solid fa-circle-chevron-left"></i></button>
            <a class="navbar-brand d-none d-lg-block" href="#">Admin Dashboard</a>
            <form class="d-flex ms-auto me-3 d-none d-md-flex" id="searchForm">
                <input class="form-control form-control-sm me-2" type="search" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-sm btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="notificationDropdownToggle" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-bell"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" id="notificationDropdown">
                        <li><a class="dropdown-item" href="#">Notification 1</a></li>
                        <li><a class="dropdown-item" href="#">Notification 2</a></li>
                        <li><a class="dropdown-item" href="#">Notification 3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdownToggle" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="vendor/img/profile.png" class="rounded-circle" alt="Profile" id="profileImage"
                            width="30" height="30">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" id="profileDropdown">
                        <li><a class="dropdown-item" href="#">Change Password</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
