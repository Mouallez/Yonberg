<style>
    
    .welcome-panel h2{
        margin-bottom: 10px;
    }
    
    @media( min-width: 800px ) {

        .welcome-panel{
            width: 96%;
        }

        .width33{
            width: 29%;
            float: left;
            margin: 20px 1% 20px 0;
        }

        .width25{
            width: 23%;
            float: left;
            margin: 20px 1% 20px 0;           
        }
        
        .width50{
            width: 48%;
            float: left;
            margin: 20px 1% 20px 0;           
        }
        
    }


    .dashicons{
        font-size: 30px;
        margin-right: 20px;
    }

    #welcome-panel h2{
        font-weight: 800;
    }

    .theme-box{
        border: 1px solid #e1e1e1;
        background: #fff;
    }

    .theme-box img{
        width: 100%;
    }
  
    .theme-box h2,
    .theme-box p{
        padding: 0 10px;
    }
    
    .theme-box .buttons{
        padding: 10px;
    }
</style>


<div id="welcome-panel" class="welcome-panel">
    <div class="welcome-panel-content">
        <h2>Zeal - WordPress theme by Smartcat</h2>
        <p>You are currently using version <strong><?php echo ZEAL_VERSION;?></strong> of the Zeal Pro theme</p>
    </div>
</div>

<div id="welcome-panel" class="welcome-panel width33">
    <div class="welcome-panel-content">
        <h2>Getting Started</h2>
        <p>Once you have installed and activated the theme, please make sure to activate the license you received when you purchased the theme.</p>
        <p><a href="<?php echo admin_url('themes.php?page=zeal-pro-license') ?>" class="button button-primary"><?php _e( 'Zeal License', 'zeal' ); ?></a></p>
    </div>
</div>

<div id="welcome-panel" class="welcome-panel width33">
    <div class="welcome-panel-content">
        <h2>Zeal Documentation</h2>
        <p>Zeal is well documented, and it has instructions showing you how to set up your preferences. </p>
        <p><a href="https://github.com/smartcatdev/docs/blob/master/zeal.pdf" target="_BLANK" class="button button-primary"><?php _e( 'Theme Documentation', 'zeal' ); ?></a></p>
    </div>
</div>

<div id="welcome-panel" class="welcome-panel width33">
    <div class="welcome-panel-content">
        <h2>1-Click Import Settings</h2>
        <p>If you have used the free version of Zeal, and have upgraded to pro, you may want to import the settings from Zeal, so you don't have to do the work twice.
        Click on the Import button, and the data you had changed in the Zeal Theme Options will be replicated in Zeal Pro.
        This will over-ride any changes to theme options you made to Zeal Pro
        </p>

        
        <p>Click here to import</p>
        <p><a onclick="r = confirm('Are you sure ? If you click OK, all settings will be overwritten from the settings of Zeal Free'); if( !r ) return false;" href="<?php echo admin_url() ?>admin.php?page=zeal_menu&do_import=true" class="button button-primary"><?php _e( 'Import Now', 'zeal' ); ?></a></p>
        <?php 
        if( isset($_GET['do_import']) ) :

            $zeal_options = get_option('theme_mods_zeal');

            if( !get_option('theme_mods_zeal-pro-1.0.1') ) :
                add_option('theme_mods_zeal-pro-1.0.1');
            endif;
            
            update_option( 'theme_mods_zeal_pro', $zeal_options );
            
            
            echo '<p style="color: green; font-weight: 800">-- Import Successful! New settings now applied to the theme options and can be viewed/edited in Customizer</p>';
        endif;
        ?>        
    </div>
</div>


<div class="clear"></div>

<div id="welcome-panel" class="welcome-panel">
    <div class="welcome-panel-content">
        <h2><span class="dashicons dashicons-art"></span> Smartcat Themes & Plugins</h2>
        <p>If you like Zeal, you should have a look at our other themes! We have created many beautiful, fully responsive and professional themes that are very user-friendly, and will dazzle your viewers. Take a look at some of these:</p>

    </div>
</div>

<div class="width33 theme-box">
    <h2>Athena</h2>
    <img src="<?php echo get_template_directory_uri() ?>/inc/images/athena-thumbnail.jpg"/>
    <p>
        Build your site Athena with ease. Athena is a feature-loaded, user-friendly, fully responsive, Parallax modern WordPress theme built with care and SEO in mind. It is a Woocommerce ready, multi-purpose theme with a design that can be used by a business, restaurant, freelancers, photographers, bloggers, musicians and creative agencies.
    </p>
    <div class="buttons">
        <a target="_BLANK" href="http://athena.smartcatdev.wpengine.com/" target="_BLANK" class="button button-primary">Live Demo</a>
    </div>

</div>

<div class="width33 theme-box">
    <h2>Relia</h2>
    <img src="<?php echo get_template_directory_uri() ?>/inc/images/aurelia.jpg"/>
    <p>
        A professional theme that can be great if you are advertising a product or services. Great for startups and businesses. Full parallax jumbotron & slider. Pricing tables, FAQs, Callouts and more! Woocommerce fully integrated.
    </p>
    <div class="buttons">
        <a target="_BLANK" href="http://relia.smartcatdev.wpengine.com/" target="_BLANK" class="button button-primary">Live Demo</a>
    </div>

</div>

<div class="width33 theme-box">
    <h2>WP Construction Mode</h2>
    <img src="<?php echo get_template_directory_uri() ?>/inc/images/wp-construction.jpg"/>
    <p>This plugin allows you to set your site Under Construction Mode. Select one of the 5 beautiful & customizable templates, capture email signups, display a contact form and details about yourself, your site, business etc. </p>
    <div class="buttons">
        <a target="_BLANK" href="http://construction.smartcatdev.wpengine.com/" target="_BLANK" class="button button-primary">Live Demo</a>
    </div>

</div>



<div class="clear"></div>