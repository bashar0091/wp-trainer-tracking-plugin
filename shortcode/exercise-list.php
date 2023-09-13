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

        foreach ($child_terms as $child_term) {
            ?>

            <div class="<?php echo $child_term->slug; ?> option_form my-5 border p-3 option-1" data-x-wrapper="exercise">
                <div class="row">
                    <div class="col-12">
                        <h4><?php echo $child_term->name; ?></h4>
                    </div>
                </div>

                <div class="repeate_wrapper row mb-3" data-x-group>
                    <div class="col-md-3">
                        <label for="weight" class="form-label">Weight</label>
                        <input type="text" class="form-control" name="<?php echo $child_term->slug;?>-weight" id="weight">
                    </div>
                    <div class="col-md-3">
                        <label for="reps" class="form-label">Reps</label>
                        <input type="text" class="form-control" name="<?php echo $child_term->slug;?>-reps" id="reps">
                    </div>
                    <div class="col-md-6">
                        <label for="note2" class="form-label">Note</label>
                        <input type="text" class="form-control" name="<?php echo $child_term->slug;?>-note" id="note2">
                    </div>

                    <div class="col-12 mt-3">
                        <a href="#!" class="btn btn-danger" data-remove-btn>Remove</a>
                        <a href="#!" class="btn btn-primary" data-add-btn>Add</a>
                    </div>
                </div>
            </div>
            
            <?php
        }
    }
?>