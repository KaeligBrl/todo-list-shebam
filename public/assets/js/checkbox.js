$(document).ready(function () {
    let taskdoneCheckboxes = $(".taskdone");
    taskdoneCheckboxes.each(function () {
        $(this).on("click", function () {

            let taskId = $(this).data("taskdone");
            let trElement = $(`tr[data-taskdone="${taskId}"]`);
            let checkbox = $(this);

            if ($(this).is(":checked")) {
                trElement.addClass('bg-yellow-dark');
            } else {
                trElement.removeClass('bg-yellow-dark');
            }

            $.ajax({
                url: window.updateTaskUrl ? window.updateTaskUrl.replace('TASK_ID', taskId) : `/semaine-actuelle/api/update-task/${taskId}`,
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    done: $(this).is(":checked"),
                }),
                success: function(response) {
                    console.log('Tâche mise à jour avec succès');
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors de la mise à jour:', error);
                    console.error('Statut:', xhr.status);
                    console.error('Réponse:', xhr.responseText);
                    
                    // Remettre la checkbox et la classe dans l'état précédent
                    if (checkbox.is(":checked")) {
                        checkbox.prop('checked', false);
                        trElement.removeClass('bg-yellow-dark');
                    } else {
                        checkbox.prop('checked', true);
                        trElement.addClass('bg-yellow-dark');
                    }
                }
            });
        });
    });
});