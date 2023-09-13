<?php

/**
 * 
 * Shortcode for trainer dashboard
 * 
 */

function trainer_dashboard_shortcode() {

    if( !is_user_logged_in() ) {
        wp_redirect(home_url().'/login');
        die();
    }


    $current_user = wp_get_current_user();
    $current_username = '';
    if ($current_user->ID != 0) {
        $current_username = $current_user->user_login;
    }


    ?>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Welcome "<?php echo $current_username;?>"</h1>
                </div>

                <div class="col-12">
                    <button type="button" class="btn btn-primary">  
                        <a href="<?php echo home_url();?>/new-exercise">Add New</a>
                    </button>
                    <button type="button" class="btn btn-primary">  
                        <a href="<?php echo home_url();?>/logout">Logout</a>
                    </button>
                </div>
            </div>

            <div class="row mt-5">

                <?php

                    $current_user = wp_get_current_user();

                    $args = array(
                        'post_type' => 'trainer-record',
                        'posts_per_page' => -1,
                        'author' => $current_user->ID,
                    );

                    $query = new WP_Query($args);

                    if( $query->have_posts() ) {
                        while( $query->have_posts() ) {
                            $query->the_post();
                            ?>
                                <div class="col-sm-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">

                                            <h5 class="card-title"><?php echo get_the_title();?></h5>
                                            <p class="card-text"><?php echo get_field('note');?></p>

                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="<?php echo get_the_permalink();?>">View</a></li>
                                                    <li><a class="dropdown-item" href="#">Edit</a></li>
                                                    <li>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="post_id" value="<?php echo get_the_ID();?>">
                                                            <button type="submit" name="delete_exercise" class="dropdown-item">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php
                        }

                        wp_reset_postdata();
                    } else {
                        ?>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h5 class="card-title">No Record Found</h5>

                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>

            </div>
        </div>
    </section>
    
    <?php

}
add_shortcode( 'trainer-dashboard', 'trainer_dashboard_shortcode' );