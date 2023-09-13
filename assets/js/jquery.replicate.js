/**
 * Add more forms v0.0.1
 * Author: Satpal Bhardwaj
 * Description: Add more forms, change each input naming and grouping
 * 
 * options: {
 *  disable-naming: boolean,
 *  wrapper: string,
 *  group: string,
 *  add-btn: string,
 *  remove-btn: string
 * }
 */

(function ($) {
  'use strict';

  const trimAttr = (attr) => attr.replace('[', '').replace(']', '');

  const setupInputNames = (wrapper, group, arrayName, disableNaming) => {
    let currentIndex = 0; // Initialize the index to 0
    $(wrapper).find(group).each((index, element) => {
      $(element).attr(trimAttr(group), currentIndex);
      $(element)
        .find('input, select')
        .each((ix, inputElement) => {
          if (typeof $(inputElement).attr(trimAttr(disableNaming)) === 'undefined') {
            const name = getInputName(inputElement);
            $(inputElement).attr('name', `${arrayName}[0][${name}]`); // Set the index to 0 for each input
          }
        });
      currentIndex++;
    });
  };

  const getInputName = (input) => {
    let name = $(input).attr('data-name');
    if (!name) {
      name = $(input).attr('name');
      $(input).attr('data-name', name);
    }
    return name;
  };

  $.fn.replicate = function (options = {}) {
    const { disableNaming, wrapper, group, addBtn, removeBtn } = options;
    if (!wrapper || !group || !addBtn || !removeBtn) {
      throw new Error('Missing required options');
    }

    const arrayName = $(this).attr(trimAttr(wrapper));
    setupInputNames(this, group, arrayName, disableNaming);

    $(document).on('click', addBtn, function () {
      const newGroup = $(this).closest(group).clone();
      newGroup.find('input:not(:radio), select').val('');
      newGroup.find('input:radio, input:checkbox').prop('checked', false);

      const wrap = $(this).closest(wrapper);
      const allGroups = $(wrap).find(group);
      const newIndex = allGroups.length; // Get the new index

      newGroup.attr(trimAttr(group), newIndex); // Set the new index for the cloned group
      newGroup
        .find('input, select')
        .each((ix, inputElement) => {
          if (typeof $(inputElement).attr(trimAttr(disableNaming)) === 'undefined') {
            const name = getInputName(inputElement);
            $(inputElement).attr('name', `${arrayName}[${newIndex}][${name}]`); // Set the new index for each input
          }
        });

      $(newGroup).insertAfter($(this).closest(group));
    });

    $(document).on('click', removeBtn, function () {
      const wrap = $(this).closest(wrapper);
      const allGroups = $(wrap).find(group);
      if (allGroups.length <= 1) {
        alert('At least one item is required!');
        return;
      }
      $(this).closest(group).remove();

      // Re-setup input names with updated indexes
      setupInputNames($(wrap), group, arrayName, disableNaming);
    });
  };
})(jQuery);