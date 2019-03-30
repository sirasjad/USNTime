<header>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/?page=home"><?php echo $this->name; ?></a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="<?php $this->activePage("home"); ?>">
                <a class="nav-link" href="/?page=home">Hjem <span class="sr-only">(current)</span></a>
            </li>

            <li class="<?php $this->activePage("attendance"); ?>"> 
                <a class="nav-link" href="/?page=attendance">Oppmøte</a>
            </li>

            <li class="<?php $this->activePage("subjects"); ?>"> 
                <a class="nav-link" href="/?page=subjects">Fagoversikt</a>
            </li>

            <li class="<?php $this->activePage("logs"); ?>"> 
                <a class="nav-link" href="/?page=logs">Brukerlogg</a>
            </li>
        </ul>

        <div class="dropdown show">
            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Min konto</a>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/?page=settings">Innstillinger</a>
                <a class="dropdown-item" href="/?page=logout">Logg ut</a>
            </div>
        </div>
    </div>
</nav>
</header>