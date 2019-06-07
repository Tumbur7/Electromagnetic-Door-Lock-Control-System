

<aside class="main-sidebar">

    <section class="sidebar">

        <?php 
            if(yii::$app->user->identity->role_id===1){ 
        ?>
   

            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site']],
                        
                        [
                            'label' => 'User', 
                            'url' => ['data/create'], 
                            'icon' => 'user',   
                            'items' => [
                                ['label' => 'Role', 'icon' => 'cog', 'url' => ['/role']],
                                ['label' => 'Add User', 'icon' => 'user-plus', 'url' => ['/user/create']],
                                ['label' => 'List User', 'icon' => 'address-book', 'url' => ['/user']],
                            ]
                        ],


    					
                        
                       
                        /*['label' => 'Request', 'icon' => 'circle-o', 'url' => ['/data/create']],*/
                        [
                            'label' => 'List Ruangan',
                            'url' => ['data/create'],
                            'icon' => 'bars', 
                            'items' => [
                                ['label' => 'List Ruangan', 'icon' => 'list-alt', 'url' => ['/daftarruangan']],
                                ['label' => 'Request Ruangan', 'icon' => 'key', 'url' => ['/data/create']],
                                ['label' => 'List Request Ruangan', 'icon' => 'outdent', 'url' => ['/data/index']],
                                
                            ]
                        ],

                        ['label' => 'Ruangan', 'icon' => 'home', 'url' => ['site/wemos']],
                    ],
                ]
            ) ?>

        <?php
            }   
            else{
        ?>
        <?php
            }
         ?>

        <?php 
            if(yii::$app->user->identity->role_id===2){ 
        ?>
<!-- dibagian ini dosen atau pemilik ruangan akan memiliki akses penuh untuk ruangan yang di ditentukan kepada dosen tersebut
    sedangkan unutk ruangan lain dosen harus requedst lagi karna tidak di beri akses pada dosen tersebut sekian
 -->
        <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site']],
                        ['label' => 'Request Ruangan', 'icon' => 'key', 'url' => ['/data/create']],
                        ['label' => 'List Request Ruangan', 'icon' => 'outdent', 'url' => ['/data/index']],
                        ['label' => 'Ruangan', 'icon' => 'home', 'url' => ['site/wemos']],
                    
                    ],
                ]
            ) ?>



        <?php
            }   
            else{
        ?>
        <?php
            }
         ?>

         <?php 
            if(yii::$app->user->identity->role_id===3){ 
        ?>
<!-- pada bagian ini mahasiswa tidak memiliki hak akses penuh pada setiap pintu, dan mereka harus request ruangna setiap mereka menggunakannya sekian -->
        <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site']],
                        ['label' => 'Request Ruangan', 'icon' => 'key', 'url' => ['/data/create']],
                        ['label' => 'List Request Ruangan', 'icon' => 'outdent', 'url' => ['/data/index']],
                    
                    ],
                ]
            ) ?>

        <?php
            }   
            else{
        ?>
        <?php
            }
         ?>
       

    </section>

</aside>
