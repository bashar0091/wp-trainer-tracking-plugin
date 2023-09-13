<?php

/**
 * 
 * Shortcode for new Exercise Form
 * 
 */

function new_exercise_shortcode() {

    if( !is_user_logged_in() ) {
        wp_redirect(home_url().'/login');
        die();
    }

    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-8 mx-auto" style="overflow:hidden;">
            
                <div class="card">
                    <div class="card-header">
                    <h1>Add New</h1>
                    </div>
                    
                    <form action="" method="post" id="step_exercise_form">

                        <section>
                            <div class="card-body">
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bw" class="form-label">BW</label>
                                        <input type="text" class="form-control" name="bw" id="bw" required>
                                    </div>
                                </div>
                            
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date" id="date" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="start_time" class="form-label">Start Time</label>
                                        <input type="time" class="form-control" name="start_time" id="start_time" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="end_time" class="form-label">End Time</label>
                                        <input type="time" class="form-control" name="end_time" id="end_time" required>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="note" class="form-label">Note</label>
                                        <input type="text" class="form-control" name="note" id="note">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-3 mx-auto">
                                        <a href="#!" class="btn btn-primary page-next">Save</a>
                                    </div>
                                </div>
                            
                            </div>
                        </section>

                        <section>
                            <div class="card-body">

                                <div>
                                    <?php
                                        $taxonomy = 'trainer-list';

                                        $terms = get_terms(array(
                                            'taxonomy' => $taxonomy,
                                            'hide_empty' => false,
                                        ));

                                        $organized_terms = array();

                                        foreach ($terms as $term) {
                                            if ($term->parent == 0) {
                                                $organized_terms[$term->term_id] = array(
                                                    'term' => $term,
                                                    'children' => array(),
                                                );
                                            } else {
                                                if (isset($organized_terms[$term->parent])) {
                                                    $organized_terms[$term->parent]['children'][] = $term;
                                                }
                                            }
                                        }

                                        foreach ($organized_terms as $parent_id => $parent_data) {
                                            $parent_term = $parent_data['term'];
                                            $child_terms = $parent_data['children'];

                                            ?>
                                            <div id="<?php echo $parent_term->slug;?>" class="parent_option_btn p-3 border btn btn-primary d-block text-start mb-2"><?php echo $parent_term->name; ?></div>
                                            <?php

                                            foreach ($child_terms as $child_term) {
                                                ?>
                                                <div id="<?php echo $child_term->slug; ?>" class="<?php echo $parent_term->slug;?> child_option_btn p-3 border btn btn-secondary d-block text-start ml-3 mb-2"><?php echo $child_term->name; ?></div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>


                                <div>

                                    <?php require_once('exercise-list.php');?>

                                </div>


                                <div class="row mt-3">
                                    <div class="col-md-3 mx-auto">
                                        <input type="submit" name="new_exercise" class="btn btn-primary" value="Save">
                                    </div>
                                </div>
                            
                            </div>
                        </section>

                    </form>
                    <!-- 
                    <div class="card-footer">
                        <button type="submit" name="new_exercise" class="btn btn-primary">Add</button>
                    </div> -->
                </div>
                    
            </div>
        </div>
    </div>


    <?php
}

add_shortcode( 'new-exercise', 'new_exercise_shortcode');