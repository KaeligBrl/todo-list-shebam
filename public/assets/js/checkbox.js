$(document).ready(function () {
    let taskdoneCheckboxes = $(".taskdone");
    taskdoneCheckboxes.each(function () {
        $(this).on("click", function () {

            let taskId = $(this).data("taskdone");
            let trElement = $(`tr[data-taskdone="${taskId}"]`);

            if ($(this).is(":checked")) {
                trElement.addClass('bg-yellow-dark');
            } else {
                trElement.removeClass('bg-yellow-dark');
            }

            $.ajax({
                url: `/semaine-actuelle/api/update-task/${taskId}`,
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    done: $(this).is(":checked"),
                }),
            });
        });
    });
});