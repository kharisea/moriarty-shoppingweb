    <!-- QUERY MENU -->
    <?php 
    if(!session()->has('role_id')){
      session()->set('role_id', 3);
    }
    $db = \Config\Database::connect();
    $role_id = session()->get('role_id');
     $queryMenu = "SELECT `users_menu`.`id`, `menu`
                    FROM `users_menu`
                    JOIN `users_access_menu` 
                    ON `users_menu`.`id` = `users_access_menu`.`menu_id`
                    WHERE `users_access_menu`.`role_id` = $role_id
                    ORDER BY `users_access_menu`.`menu_id` ASC
                    ";
    $menu = $db->query($queryMenu)->getResultArray();
     ?>

    <!-- END QUERY MENU -->

<header>
<nav class="navbar navbar-expand-lg navbar-light <?= $navbar ?>">
    <div class="container-fluid">
        <a class="navbar-brand justify-content-start" href="<?= base_url('/') ?>"><img src="<?= base_url('img/navbar/LOGO.png'); ?>" width="120" height="75"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse ms-3" id="navbarNav">
        <div class="navbar-nav menu">
          <!-- LOOPING MENU -->
          <?php foreach($menu as $m) : ?>
            
            <?php 
              $menuId = $m['id'];
              $querySubMenu = "SELECT *
                                FROM `users_sub_menu`
                                JOIN `users_menu` 
                                ON `users_sub_menu`.`menu_id` = `users_menu`.`id`
                                WHERE `users_sub_menu`.`menu_id` = $menuId
                                  AND `users_sub_menu`.`is_active` = 1
                                  AND `users_sub_menu`.`menu_id` != 1
                                  AND `users_sub_menu`.`menu_id` != 3
                                ";

            $subMenu = $db->query($querySubMenu)->getResultArray();
            ?>
              <?php foreach($subMenu as $sm) : ?>
                <?php $act = "";
                  if ($title == $sm['title']){
                  $act = "active";
                  }
                ?>
                <a class="nav-link text-light px-4 fs-6 rounded-3 <?= $act; ?>" href="<?= base_url($sm['url']); ?>"><?= $sm['title']; ?></a>

              <?php endforeach; ?>

          <?php endforeach; ?>
          <!-- END LOOPING MENU -->
        </div>
        </div>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="navbar-nav feature">
          <a class="navbar-brand me-4" href="<?= base_url('pages/cart') ?>"><img src="<?= base_url('img/navbar/addcart.png'); ?>" width="60" height="50"></a>
          
          <div class="btn-group dropstart">
            <a class="navbar-brand dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?= base_url('img/navbar/user.png'); ?>" width="60" height="50"></a>
            <ul class="dropdown-menu">
              
            <?php if(session()->has('email') && session()->has('role_id')) : ?>
              <li><a href="<?= base_url('pages/profile') ?>" class="dropdown-item text-success">Profile</a></li> <hr>
                  <?php foreach($menu as $m) : ?>
                    
                    <?php 
                      $menuId = $m['id'];
                      $querySubMenu = "SELECT *
                                        FROM `users_sub_menu`
                                        JOIN `users_menu` 
                                        ON `users_sub_menu`.`menu_id` = `users_menu`.`id`
                                        WHERE `users_sub_menu`.`menu_id` = $menuId
                                          AND `users_sub_menu`.`is_active` = 1
                                          AND `users_sub_menu`.`menu_id` != 2
                                        ";

                    $subMenu = $db->query($querySubMenu)->getResultArray();
                    ?>
                      <?php foreach($subMenu as $sm) : ?>
                        <li><a href="<?= base_url($sm['url']); ?>" class="dropdown-item text-primary"><?= $sm['title']; ?></a></li> <hr>
                      <?php endforeach; ?>

                  <?php endforeach; ?>
              <li><a href="<?= base_url('auth/logout'); ?>" class="dropdown-item text-danger">Logout</a></li>
            <?php else : ?>
              <li><a href="<?= base_url('auth/login') ?>" class="dropdown-item text-dark">Login</a></li>
              <?php endif; ?>
              
            </ul>
          </div>
        </div>
        </div>
    </div>
    </nav>
</header>