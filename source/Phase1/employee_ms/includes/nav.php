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
                        <a class="nav-link <?php echo $page==''?'active':''; ?>" href="#!">
                            <i class="fa fa-cog text-primary"></i>
                            <span class="nav-link-text">Payroll</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page==''?'active':''; ?>" href="#!">
                            <i class="fa fa-cog text-primary"></i>
                            <span class="nav-link-text">Billing Hours</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page==''?'active':''; ?>" href="#!">
                            <i class="fa fa-cog text-primary"></i>
                            <span class="nav-link-text">Leave Requests</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page==''?'active':''; ?>" href="logout.php">
                            <i class="fa fa-power-off text-primary"></i>
                            <span class="nav-link-text">Logout</span>
                        </a>
                    </li>
        
                </ul>
            </div>
        </div>
    </div>
</nav>