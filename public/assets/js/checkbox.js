window.onload = () => {
    let taskdone = document.querySelectorAll(".taskdone");

    for (button of taskdone) {
        button.addEventListener("click", function () {
            // Récupérez l'identifiant de la tâche
            let taskId = this.dataset.taskdone;

            // Récupérez le <tr> correspondant à la tâche
            let trElement = document.querySelector(`tr[data-taskdone="${taskId}"]`);

            // Ajoutez ou supprimez la classe en fonction de la propriété "checked"
            if (this.checked) {
                trElement.classList.add('bg-yellow-dark');
            } else {
                trElement.classList.remove('bg-yellow-dark');
            }

            // Envoie de la requête AJAX pour mettre à jour la couleur dans le backend
            let xhr = new XMLHttpRequest();
            xhr.open("POST", `/semaine-actuelle/api/update-task/${taskId}`, true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Succès
                        var response = JSON.parse(xhr.responseText);
                        console.log('Response from server:', response);
                    } else {
                        // Gestion des erreurs
                        console.error('Erreur lors de la mise à jour de la couleur:', xhr.status, xhr.statusText);
                    }
                }
            };

            // Envoie de la valeur de la couleur au backend
            xhr.send(JSON.stringify({
                done: this.checked,
            }));
        });
    }
};
