<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php"><?php echo $dashboard ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="newticket.php"><?php echo $create_a_ticket ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tickets.php"><?php echo $tickets ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="knowledgebase.php"><?php echo $knowledge_base ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/dashboard.php"><?php echo $administration ?></a>
            </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <il>
                    <a class="nav-link" href="logout.php">Logout</a>
                </il>
            </ul>
        </ul>
    </div>
</nav>