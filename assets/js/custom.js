var selector = '[data-x-wrapper]';
var options = {
    disableNaming: '[data-disable-naming]',
    wrapper: selector,
    group: '[data-x-group]',
    addBtn: '[data-add-btn]',
    removeBtn: '[data-remove-btn]'
};

jQuery(selector).replicate(options);


jQuery(document).ready(function($) {

    $('.option_btn').click(function() {
        var get_id = $(this).attr('id');

        $( `.${get_id}` ).addClass('show');
        
    });

    // ==========

    $('.parent_option_btn').click(function() {
        var get_id = $(this).attr('id');

        $('.child_option_btn').removeClass('show');

        $(`.${get_id}`).addClass('show');
    });

    // ==========

    $('.child_option_btn').click(function() {
        var get_id = $(this).attr('id');

        $(`.${get_id}`).addClass('show');

        $('.child_option_btn').removeClass('show');
    });

    // ==========

    $thing = $('#step_exercise_form').book({
        onPageChange:updateProgress,
        speed:200}
    ).validate();
    /* IE doesn't have a trunc function */
    if (!Math.trunc) {
        Math.trunc = function (v) {
            return v < 0 ? Math.ceil(v) : Math.floor(v);
        };
    }
    /* Update progress bar whenever the page changes */
    function updateProgress(prevPageIndex, currentPageIndex, pageCount, pageName){
        t = (currentPageIndex / (pageCount-1)) * 100;

        $('.progress-bar').attr('aria-valuenow', t);
        $('.progress-bar').css('width', t+'%');

    }

});