/*
 * This script allows the selection of sub-checkbox
 * when the mother checkbox is created
 */
$(document).ready(function () {

    $(".gyn-treeview").delegate("label input:checkbox", "change", function () {
        var checkbox = $(this),
            nestedList = checkbox.parent().next().next(),
            selectNestedListCheckbox = nestedList.find("label:not([for]) input:checkbox");
        if (checkbox.is(":checked")) {
            return selectNestedListCheckbox.prop("checked", true);
        }
        selectNestedListCheckbox.prop("checked", false);
    });

});