<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="navbar-brand">
            <center>
                <a class="" href="index.php">
                   Employee <br> Management
                </a>
            </center>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page=='index'?'active':''; ?>" href="index.php">
                            <i class="fa fa-home text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page=='billing-hours'?'active':''; ?>" href="billing-hours.php">
                            <i class="fa fa-cog text-warning"></i>
                            <span class="nav-link-text">Billing Hours</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page=='leave-requests'?'active':''; ?>" href="leave-requests.php">
                            <i class="fa fa-cog text-success"></i>
                            <span class="nav-link-text">Leave Requests</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page=='payroll'?'active':''; ?>" href="payroll.php">
                            <i class="fa fa-money-bill text-danger"></i>
                            <span class="nav-link-text">Payroll</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page=='my-profile'?'active':''; ?>" href="my-profile.php">
                            <i class="fa fa-user text-info"></i>
                            <span class="nav-link-text">My Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page==''?'active':''; ?>" href="logout.php">
                            <i class="fa fa-power-off text-danger"></i>
                            <span class="nav-link-text">Logout</span>
                        </a>
                    </li>
        
                </ul>
            </div>
        </div>
    </div>
</nav>