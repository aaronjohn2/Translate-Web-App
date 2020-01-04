<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo DIR; ?>"><?php echo SITETITLE; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo DIR.'memberpage.php'; ?>">Dashboard</a></li>
                <li><a href="<?php echo DIR.'upload.php'; ?>">Upload text file</a></li>
                <li><a href="<?php echo DIR.'translate.php'; ?>">Translate Now</a></li>
                <?php if ($user->is_logged_in()) { ?>
                <li><a href="<?php echo DIR.'logout.php'; ?>">Sign Out</a></li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Welcome <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo DIR.'logout.php'; ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
</nav>