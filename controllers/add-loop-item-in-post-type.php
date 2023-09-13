<?php

function exercise_list_show() {
    add_meta_box(
        'exercise_list_meta_box',
        'Exercise List',
        'exercise_list',
        'trainer-record',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'exercise_list_show');


function exercise_list($post) {
    $exercise_list = get_post_meta($post->ID, 'exercise_list', true);
    $exercise_list = json_decode($exercise_list, true);

    if (!empty($exercise_list)) {
        foreach ($exercise_list as $category => $exercises) {
            echo '<h3>' . esc_html($category) . '</h3>'; // Display the category name

            echo '<table class="wp-list-table widefat fixed striped table-view-list posts">';
            echo '<thead><tr><th>Weight</th><th>Reps</th><th>Note</th></tr></thead>';
            echo '<tbody>';
            
            foreach ($exercises as $exercise) {
                echo '<tr>';
                echo '<td>' . esc_html($exercise['weight']) . '</td>';
                echo '<td>' . esc_html($exercise['reps']) . '</td>';
                echo '<td>' . esc_html($exercise['note']) . '</td>';
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
        }
    }
}

