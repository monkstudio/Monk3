<?php if(Monk\Utils\can_skip()) return ?>

<header id="masthead" >
    
    <div class="container wrapper" >
    
        <?php get_partial('logo', get_template_slug(), [ 'main' => true, 'width' => '140px' ]) ?>
        
        <?php
        /**
         *  Here’s the list of hamburger-type classes you can choose from:
         *  NOTE: Make sure the corresponding 'type' is enabled in the _variables scss file.
         * 
         *  hamburger--3dx
         *  hamburger--3dx-r
         *  hamburger--3dy
         *  hamburger--3dy-r
         *  hamburger--arrow
         *  hamburger--arrow-r
         *  hamburger--arrowalt
         *  hamburger--arrowalt-r
         *  hamburger--boring
         *  hamburger--collapse
         *  hamburger--collapse-r
         *  hamburger--elastic
         *  hamburger--elastic-r
         *  hamburger--emphatic
         *  hamburger--emphatic-r
         *  hamburger--slider
         *  hamburger--slider-r
         *  hamburger--spin
         *  hamburger--spin-r
         *  hamburger--spring
         *  hamburger--spring-r
         *  hamburger--stand
         *  hamburger--stand-r
         *  hamburger--squeeze
         *  hamburger--vortex
         *  hamburger--vortex-r
         */
        ?>
        <button class="collapsed hamburger hamburger--spin" data-toggle="dropdown" data-target="#main-menu-wrapper" type="button" aria-haspopup="true" aria-expanded="false" >
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        
        <nav class="navbar navbar-main" >
            
            <div class="collapse navbar-collapse" id="main-menu-wrapper" >
                <?php
                wp_nav_menu([
                    'theme_location'    => 'primary',
                    'menu_class'        => 'nav navbar-nav navbar-right',
                    'menu_id'           => 'main-menu',
                    'walker'            => new Roots\Soil\Nav\NavWalker()
                ])
                ?>
            </div>
            
            <?php
                wp_nav_menu([
                    'theme_location'    => 'social',
                    'menu_class'        => 'nav nav-inline navbar-nav navbar-right',
                    'menu_id'           => 'social-menu',
                    'walker'            => new Roots\Soil\Nav\NavWalker()
                ]);
            ?>

        </nav>
    
    </div>
   
</header>

<main role="main" id="main" >