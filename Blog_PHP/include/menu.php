<?php
  
  $emailSession = '';
  if(isset($_SESSION['email']) && $_SESSION ['email'] != ''){
              $emailSession = $_SESSION['email'];
  }


?>
<!-- Intégration du menu pour l' inclure dans les différents template avec le include -->

<div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="index.php" class="nav-link <?php if($page == 'index'){echo 'active' ;} ?>" aria-current="page">Acceuil</a></li>
        <li class="nav-item"><a href="articles.php" class="nav-link <?php if($page == 'article'){echo 'active' ;} ?>">Articles</a></li>
        <li class="nav-item"><a href="auteurs.php" class="nav-link <?php if($page == 'auteur'){echo 'active' ;} ?>">Auteurs</a></li>  
        <li class="nav-item"><a href="article_new.php" class="nav-link <?php if($page == 'new'){echo 'active';} ?>">Nouvel Article</a></li>  
          <?php if($emailSession == ''){?>
            <li class="nav-item"><a href="connexion.php" class="nav-link <?php if($page == 'connexion'){echo 'active' ;} ?>">Connexion</a></li>
            <li class="nav-item"><a href="register.php" class="nav-link <?php if($page == 'inscription'){echo 'active' ;} ?>">Inscription</a></li>
          <?php }else{ ?>
            <li class="nav-item nav-link ">bonjour <?php echo $emailSession; ?></li>
            <li class="nav-item "><a class="nav-link" href="logout.php">Me deconnecter</a></li>
       <?php } ?>
      </ul>
    </header>
</div>