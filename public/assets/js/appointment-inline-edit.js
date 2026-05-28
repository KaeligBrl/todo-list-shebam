(function ($) {
    "use strict";

    function escapeHtml(value) {
        return $("<div>").text(value ?? "").html();
    }

    function replaceId(urlTemplate, id) {
        return String(urlTemplate || "").replace("ITEM_ID", String(id || ""));
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

    function initUsersTomSelect($row) {
        if (typeof window.TomSelect === "undefined") {
            return;
        }

        var usersSelect = $row.find("select.js-inline-edit-appt-users").get(0);
        if (usersSelect && !usersSelect.tomselect) {
            new TomSelect(usersSelect, {
                plugins: ["remove_button"],
                create: false,
                persist: false,
                maxOptions: null,
                hideSelected: true,
                closeAfterSelect: false,
                sortField: { field: "text", direction: "asc" }
            });
        }
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

    function renderUsers(item) {
        var users = Array.isArray(item.users) ? item.users : [];
        return users.map(function (name) {
            return escapeHtml(name) + " <br>";
        }).join("");
    }

    function bindAppointmentInlineEdit() {
        var cfg = window.appointmentInlineEditConfig || {};
        var updateUrlTemplate = cfg.updateUrlTemplate;
        var rowSelector = cfg.rowSelector || "#inlineEditAppointmentRow";
        var errorSelector = cfg.errorRowSelector || "#inlineEditAppointmentErrors";

        var $editRow = $(rowSelector);
        var $errorRow = $(errorSelector);

        if (!updateUrlTemplate || $editRow.length === 0 || $errorRow.length === 0) {
            return;
        }

        initUsersTomSelect($editRow);

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
            var sourceId = String($editRow.attr("data-source-id") || "");
            if (sourceId !== "") {
                $("tr[data-appointment-id='" + sourceId + "']").removeClass("d-none");
            }

            $editRow.attr("data-source-id", "");
            $editRow.detach().addClass("d-none");
            $errorRow.detach().addClass("d-none");
            clearError();
        }

        function openEditor(id) {
            var rowId = String(id || "");
            if (rowId === "") {
                return;
            }

            var $sourceRow = $("tr[data-appointment-id='" + rowId + "']").first();
            if ($sourceRow.length === 0) {
                return;
            }

            closeEditor();

            $editRow.find(".js-inline-edit-appt-name").val(String($sourceRow.attr("data-name") || ""));
            $editRow.find(".js-inline-edit-appt-subject").val(String($sourceRow.attr("data-subject") || ""));
            $editRow.find(".js-inline-edit-appt-hours").val(String($sourceRow.attr("data-hours-value") || ""));
            setMultiValue($editRow.find(".js-inline-edit-appt-users"), splitIds($sourceRow.attr("data-user-ids")));

            $sourceRow.after($editRow);
            $editRow.after($errorRow);
            $sourceRow.addClass("d-none");
            $editRow.removeClass("d-none");
            $editRow.attr("data-source-id", rowId);
            clearError();
        }

        $(document).on("click", ".js-inline-edit-appointment-toggle", function (e) {
            e.preventDefault();
            openEditor($(this).data("id"));
        });

        $(document).on("click", ".js-inline-edit-appt-cancel", function () {
            closeEditor();
        });

        $(document).on("click", ".js-inline-edit-appt-save", function () {
            var rowId = String($editRow.attr("data-source-id") || "");
            if (rowId === "") {
                return;
            }

            var payload = {
                name: String($editRow.find(".js-inline-edit-appt-name").val() || ""),
                subject: String($editRow.find(".js-inline-edit-appt-subject").val() || ""),
                hoursappointment: String($editRow.find(".js-inline-edit-appt-hours").val() || ""),
                user_ids: $editRow.find(".js-inline-edit-appt-users").val() || []
            };

            $.ajax({
                url: replaceId(updateUrlTemplate, rowId),
                method: "POST",
                dataType: "json",
                data: payload,
                headers: { "X-Requested-With": "XMLHttpRequest" }
            }).done(function (response) {
                if (!response || !response.success || !response.appointment) {
                    showError(["Mise a jour impossible."]);
                    return;
                }

                var item = response.appointment;
                var $sourceRow = $("tr[data-appointment-id='" + rowId + "']").first();
                if ($sourceRow.length === 0) {
                    closeEditor();
                    return;
                }

                $sourceRow.attr("data-name", String(item.name || ""));
                $sourceRow.attr("data-subject", String(item.subject || ""));
                $sourceRow.attr("data-hours-value", String(item.hours_value || ""));
                $sourceRow.attr("data-user-ids", Array.isArray(item.user_ids) ? item.user_ids.join(",") : "");

                $sourceRow.children("td").eq(1).text(String(item.hours_display || ""));
                $sourceRow.children("td").eq(2).text(String(item.name || ""));
                $sourceRow.children("td").eq(3).text(String(item.subject || ""));
                $sourceRow.children("td").eq(4).html(renderUsers(item));

                closeEditor();
            }).fail(function (xhr) {
                var errors = xhr.responseJSON && Array.isArray(xhr.responseJSON.errors)
                    ? xhr.responseJSON.errors
                    : ["Une erreur est survenue."];
                showError(errors);
            });
        });
    }

    $(bindAppointmentInlineEdit);
})(jQuery);
