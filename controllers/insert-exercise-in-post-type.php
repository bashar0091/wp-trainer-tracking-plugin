<?php

/**
 * 
 * Exercise Insert In Post Type
 * 
 */ 

 function exercise_insert_in_post_type() {

    if (isset($_POST['new_exercise'])) {
        
        // $name = $_POST['name'];
        // $bw = $_POST['bw'];
        // $date = $_POST['date'];
        // $start_time = $_POST['start_time'];
        // $end_time = $_POST['end_time'];
        // $note = $_POST['note'];
        
        // $post_data = array(
        //     'post_title'   => $name,
        //     'post_status'  => 'publish',
        //     'post_type'    => 'trainer-record',
        // );

        // // Insert the new post
        // $insert_result = wp_insert_post($post_data);

        // if ($insert_result) {

        //     // Insert the post meta
        //     add_post_meta($insert_result, 'bw', $bw, true);
        //     add_post_meta($insert_result, 'date', $date, true);
        //     add_post_meta($insert_result, 'start_time', $start_time, true);
        //     add_post_meta($insert_result, 'end_time', $end_time, true);
        //     add_post_meta($insert_result, 'note', $note, true);
        // }

        // wp_redirect( home_url() );
        // exit;


        // Initialize an empty associative array to store the form data
        // Initialize an empty associative array to store the form data
        $exerciseData = [];

        // Loop through each group of exercises (e.g., "head", "shoulder", "thai")
        $exerciseGroups = ['head', 'shoulder', 'thai'];

        foreach ($exerciseGroups as $group) {
            // Initialize an empty array for the current group
            $groupData = [];

            // Loop through each repetition within the group
            $repetition = 0;
            $hasData = false; // Flag to check if the group has at least one data item

            while (isset($_POST['exercise'][$repetition][$group . '-weight'])) {
                // Create an associative array for the repetition
                $exerciseRepetition = [
                    'weight' => $_POST['exercise'][$repetition][$group . '-weight'],
                    'reps' => $_POST['exercise'][$repetition][$group . '-reps'],
                    'note' => $_POST['exercise'][$repetition][$group . '-note'],
                ];

                // Add the repetition data to the group array
                $groupData[] = $exerciseRepetition;
                $hasData = true; // Set the flag to true since there's at least one data item

                $repetition++;
            }

            // Add the group array to the exerciseData only if it has at least one item
            if ($hasData) {
                $exerciseData[$group] = $groupData;
            }
        }

        // Now, $exerciseData contains the associative array with the form data
        // You can use $exerciseData as needed
        echo '<pre>';
        print_r($exerciseData);
        echo '</pre>';

        

    }

    if(isset($_POST['delete_exercise'])) {

        $post_id = $_POST['post_id'];

        wp_delete_post($post_id, true);

        wp_redirect( home_url() );
        exit;
    }

}

add_action('init', 'exercise_insert_in_post_type');