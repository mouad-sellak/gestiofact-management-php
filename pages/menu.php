<?php include('Identification.php') ?>
<div class="col-md-3 left_col"   >
          <div class="left_col scroll-view"   >
            <div class="navbar "  >
              <a href="Accueil.php" class="site_title">
              <!-- <i class="fab fa-gofore"></i>
                <span>
                <b style="color:white;font-size:25px;" >GestioFact</b>
              </span> -->
				    	<img src="../images/logo1.png" width="140px"  height="40px" >
            </a>
            </div>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" >
              <div class="menu_section" >
                <ul class="nav side-menu">
                  <li><a style="font-size:15px;"  href="Accueil.php"><i class="fas fa-home"></i>&nbsp; Acceuil </a></li>
                  <li><a style="font-size:15px;" ><i class="fas fa-users"></i> &nbsp; Utilisateurs <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="AjouterUtilisateur.php"><b style="font-size:14px" >Ajouter Utilisateur</b></a></li>
                      <li><a href="Utilisateurs.php"><b style="font-size:14px" >Gestion des utilisateurs</b></a></li>
                    </ul>
                  </li>
                  <li><a style="font-size:15px;"><i  class="fas fa-user"></i> &nbsp; Clients <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="AjouterClient.php"><b style="font-size:14px" >Ajouter Client</b></a></li>
                      <li><a href="Clients.php"><b style="font-size:14px" >Gestion des clients</b></a></li>
                    </ul>
                  </li>
                   <li><a style="font-size:15px;" ><i  class="fas fa-wrench"></i> &nbsp; Objets <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="AjouterObjet.php"><b style="font-size:14px" >Ajouter Objet</b></a></li>
                      <li><a href="Objets.php"><b style="font-size:14px" >Gestion des Objets</b></a></li>
                    </ul>
                  </li>

                  <li><a style="font-size:15px;" ><i  class="fas fa-cogs"></i> &nbsp; Services <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="AjouterService.php"><b style="font-size:14px" >Ajouter service</b></a></li>
                      <li><a href="Services.php"><b style="font-size:14px" >Gestion des services</b></a></li>
                    </ul>
                  </li>
                  <li><a style="font-size:15px;" ><i class="fas fa-file-invoice"></i> &nbsp; Devis <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="AjouterDevis.php"><b style="font-size:14px" >Ajouter devis</b></a></li>
                      <li><a href="Devis.php"><b style="font-size:14px" >Gestion des devis</b></a></li>
                    </ul>
                  </li>
               
                  <li><a style="font-size:15px;" ><i class="fas fa-file-invoice-dollar"></i> &nbsp; Factures <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="AjouterFacture.php"><b style="font-size:14px" >Ajouter facture</b></a></li>
                      <li><a href="Factures.php"><b style="font-size:14px" >Gestion des factures</b></a></li>
                    </ul>
                  </li>
                  
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav" >
          <div class="nav_menu" style="background-color:#2A3F54;">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i style="color:aliceblue;" class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <b style="color:aliceblue"><?php if(isset($_SESSION['user'])) echo $_SESSION['user']['login'];  ?></b>
                    <span class=" fa fa-angle-down" style="color:aliceblue;"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="ModifierUtilisateur.php?id=<?php if(isset($_SESSION['user'])) echo $_SESSION['user']['id']  ?>"> Profil</a></li>
                    <li><a href="Login.php"><i class="fa fa-sign-out pull-right"></i>Déconnexion</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>