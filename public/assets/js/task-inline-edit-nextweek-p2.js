(function ($) {
    "use strict";

    function escapeHtml(value) {
        return $("<div>").text(value ?? "").html();
    }

    function replaceTaskId(urlTemplate, taskId) {
        return String(urlTemplate || "").replace("TASK_ID", String(taskId || ""));
    }

    function splitIds(value) {
        var raw = String(value || "").trim();
        if (raw === "") {
            return [];
        }

        return raw.split(",").map(function (id) {
            return String(id || "").trim();
        }).filter(function (id) {
            return id !== "";
        });
    }

    function initInlineEditTomSelects($row) {
        if (typeof window.TomSelect === "undefined") {
            return;
        }

        var customerSelect = $row.find("select.js-inline-edit-customer").get(0);
        if (customerSelect && !customerSelect.tomselect) {
            new TomSelect(customerSelect, {
                dropdownParent: "body",
                closeAfterSelect: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        }

        var usersSelect = $row.find("select.js-inline-edit-users").get(0);
        if (usersSelect && !usersSelect.tomselect) {
            new TomSelect(usersSelect, {
                plugins: ["remove_button"],
                create: false,
                persist: false,
                maxOptions: null,
                hideSelected: true,
                closeAfterSelect: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        }
    }

    function setSingleValue($select, value) {
        var val = String(value || "");
        if ($select.length === 0) {
            return;
        }

        var element = $select.get(0);
        if (element.tomselect) {
            element.tomselect.clear(true);
            if (val !== "") {
                element.tomselect.setValue(val, true);
            }
            return;
        }

        $select.val(val);
    }

    function setMultiValue($select, values) {
        if ($select.length === 0) {
            return;
        }

        var ids = (values || []).map(function (id) {
            return String(id || "");
        });

        var element = $select.get(0);
        if (element.tomselect) {
            element.tomselect.clear(true);
            element.tomselect.setValue(ids, true);
            return;
        }

        $select.val(ids);
    }

    function renderSubjectCell(taskData) {
        var object = String(taskData.subject || "");
        var sub1 = String(taskData.subobject1 || "");
        var sub2 = String(taskData.subobject2 || "");
        var sub3 = String(taskData.subobject3 || "");
        var lines = [];

        if (object !== "") {
            lines.push(escapeHtml(object));
        }
        if (sub1 !== "") {
            lines.push(escapeHtml(sub1));
        }
        if (sub2 !== "") {
            lines.push(escapeHtml(sub2));
        }
        if (sub3 !== "") {
            lines.push(escapeHtml(sub3));
        }

        return lines.join("<br>");
    }

    function renderUsersCell(taskData) {
        var users = Array.isArray(taskData.users) ? taskData.users : [];
        return users.map(function (name) {
            return escapeHtml(name) + " <br>";
        }).join("");
    }

    function bindInlineEditNextWeekP2() {
        var updateUrlTemplate = window.nextWeekP2InlineUpdateUrlTemplate;
        var $editRow = $("#inlineEditTaskNwP2Row");
        var $errorRow = $("#inlineEditTaskNwP2Errors");

        if (!updateUrlTemplate || $editRow.length === 0 || $errorRow.length === 0) {
            return;
        }

        initInlineEditTomSelects($editRow);

        function clearError() {
            $errorRow.addClass("d-none");
            $errorRow.find(".message-error").empty();
        }

        function showError(messages) {
            var html = (messages || ["Une erreur est survenue."]).map(function (msg) {
                return "<div>" + escapeHtml(msg) + "</div>";
            }).join("");

            $errorRow.find(".message-error").html(html);
            $errorRow.removeClass("d-none");
        }

        function closeEditor() {
            var sourceId = String($editRow.attr("data-source-task-id") || "");
            if (sourceId !== "") {
                $("tr[data-task-id='" + sourceId + "']").removeClass("d-none");
            }

            $editRow.attr("data-source-task-id", "");
            $editRow.detach().addClass("d-none");
            $errorRow.detach().addClass("d-none");
            clearError();
        }

        function openEditorForTask(taskId) {
            var id = String(taskId || "");
            if (id === "") {
                return;
            }

            var $sourceRow = $("tr[data-task-id='" + id + "']").first();
            if ($sourceRow.length === 0) {
                return;
            }

            closeEditor();

            var customerId = String($sourceRow.attr("data-customer-id") || "");
            var object = String($sourceRow.attr("data-object") || "");
            var note = String($sourceRow.attr("data-note") || "");
            var deadlineValue = String($sourceRow.attr("data-deadline-value") || "");
            var subobject1 = String($sourceRow.attr("data-subobject1") || "");
            var subobject2 = String($sourceRow.attr("data-subobject2") || "");
            var subobject3 = String($sourceRow.attr("data-subobject3") || "");
            var userIds = splitIds($sourceRow.attr("data-user-ids"));

            setSingleValue($editRow.find(".js-inline-edit-customer"), customerId);
            $editRow.find(".js-inline-edit-object").val(object);
            $editRow.find(".js-inline-edit-note").val(note);
            $editRow.find(".js-inline-edit-deadline").val(deadlineValue);
            $editRow.find(".js-inline-edit-subobject1").val(subobject1);
            $editRow.find(".js-inline-edit-subobject2").val(subobject2);
            $editRow.find(".js-inline-edit-subobject3").val(subobject3);
            setMultiValue($editRow.find(".js-inline-edit-users"), userIds);

            $sourceRow.after($editRow);
            $editRow.after($errorRow);
            $sourceRow.addClass("d-none");
            $editRow.removeClass("d-none");
            $editRow.attr("data-source-task-id", id);
            clearError();
        }

        $(document).on("click", ".js-inline-edit-toggle", function (e) {
            e.preventDefault();
            openEditorForTask($(this).data("task-id"));
        });

        $(document).on("click", ".js-inline-edit-cancel", function () {
            closeEditor();
        });

        $(document).on("click", ".js-inline-edit-save", function () {
            var taskId = String($editRow.attr("data-source-task-id") || "");
            if (taskId === "") {
                return;
            }

            var payload = {
                customer_id: String($editRow.find(".js-inline-edit-customer").val() || ""),
                object: String($editRow.find(".js-inline-edit-object").val() || ""),
                subobject1: String($editRow.find(".js-inline-edit-subobject1").val() || ""),
                subobject2: String($editRow.find(".js-inline-edit-subobject2").val() || ""),
                subobject3: String($editRow.find(".js-inline-edit-subobject3").val() || ""),
                deadline: String($editRow.find(".js-inline-edit-deadline").val() || ""),
                note: String($editRow.find(".js-inline-edit-note").val() || ""),
                user_ids: $editRow.find(".js-inline-edit-users").val() || []
            };

            $.ajax({
                url: replaceTaskId(updateUrlTemplate, taskId),
                method: "POST",
                dataType: "json",
                data: payload,
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).done(function (response) {
                if (!response || !response.success || !response.task) {
                    showError(["Mise a jour impossible."]);
                    return;
                }

                var taskData = response.task;
                var $sourceRow = $("tr[data-task-id='" + taskId + "']").first();
                if ($sourceRow.length === 0) {
                    closeEditor();
                    return;
                }

                $sourceRow.attr("data-customer-id", String(taskData.customer_id || ""));
                $sourceRow.attr("data-object", String(taskData.subject || ""));
                $sourceRow.attr("data-subobject1", String(taskData.subobject1 || ""));
                $sourceRow.attr("data-subobject2", String(taskData.subobject2 || ""));
                $sourceRow.attr("data-subobject3", String(taskData.subobject3 || ""));
                $sourceRow.attr("data-deadline-value", String(taskData.deadline_value || ""));
                $sourceRow.attr("data-note", String(taskData.note || ""));
                $sourceRow.attr("data-user-ids", Array.isArray(taskData.user_ids) ? taskData.user_ids.join(",") : "");

                $sourceRow.children("td").eq(1).text(String(taskData.customer || ""));
                $sourceRow.children("td").eq(2).html(renderSubjectCell(taskData));
                $sourceRow.children("td").eq(3).html(renderUsersCell(taskData));
                $sourceRow.children("td").eq(4).text(String(taskData.deadline_display || ""));
                $sourceRow.children("td").eq(5).text(String(taskData.note || ""));

                closeEditor();
                window.dispatchEvent(new Event("task-live-local-change"));
            }).fail(function (xhr) {
                var errors = xhr.responseJSON && Array.isArray(xhr.responseJSON.errors)
                    ? xhr.responseJSON.errors
                    : ["Une erreur est survenue."];
                showError(errors);
            });
        });
    }

    $(bindInlineEditNextWeekP2);
})(jQuery);
