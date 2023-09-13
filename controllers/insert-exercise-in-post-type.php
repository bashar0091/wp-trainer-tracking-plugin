<?php

/**
 * 
 * Exercise Insert In Post Type
 * 
 */ 

 function exercise_insert_in_post_type() {

    if (isset($_POST['new_exercise'])) {


        // loop data store in database
        $exerciseData = [];
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
                $exerciseGroups[] = $child_term->slug;
            }
        }

        foreach ($exerciseGroups as $group) {
            $groupData = [];
            $repetition = 0;
            $hasData = false;

            while (isset($_POST['exercise'][$repetition][$group . '-weight'])) {
                $exerciseRepetition = [
                    'weight' => $_POST['exercise'][$repetition][$group . '-weight'],
                    'reps' => $_POST['exercise'][$repetition][$group . '-reps'],
                    'note' => $_POST['exercise'][$repetition][$group . '-note'],
                ];

                $groupData[] = $exerciseRepetition;
                $hasData = true;

                $repetition++;
            }

            if ($hasData) {
                $exerciseData[$group] = $groupData;
            }
        }

        $exercise_list = json_encode($exerciseData);



        // ========
        
        $name = $_POST['name'];
        $bw = $_POST['bw'];
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $note = $_POST['note'];
        
        $post_data = array(
            'post_title'   => $name,
            'post_status'  => 'publish',
            'post_type'    => 'trainer-record',
        );

        // Insert the new post
        $insert_result = wp_insert_post($post_data);

        if ($insert_result) {

            // Insert the post meta
            add_post_meta($insert_result, 'bw', $bw, true);
            add_post_meta($insert_result, 'date', $date, true);
            add_post_meta($insert_result, 'start_time', $start_time, true);
            add_post_meta($insert_result, 'end_time', $end_time, true);
            add_post_meta($insert_result, 'note', $note, true);
            add_post_meta($insert_result, 'exercise_list', $exercise_list, true);
        }

        wp_redirect( home_url() );
        exit;

    }

    if(isset($_POST['delete_exercise'])) {

        $post_id = $_POST['post_id'];

        wp_delete_post($post_id, true);

        wp_redirect( home_url() );
        exit;
    }

}

add_action('init', 'exercise_insert_in_post_type');