(function ($) {
    "use strict";

    function decodeHtml(value) {
        return $("<textarea>").html(value || "").text();
    }

    function escapeHtml(value) {
        return $("<div>").text(value ?? "").html();
    }

    function replaceTaskId(urlTemplate, id) {
        return String(urlTemplate || "").replace("TASK_ID", String(id));
    }

    function escapeJsSingleQuote(value) {
        return String(value ?? "").replace(/\\/g, "\\\\").replace(/'/g, "\\'");
    }

    function resetCustomerSelect($form) {
        $form.find("select.js-task-customer-select").each(function () {
            if (this.tomselect) {
                this.tomselect.clear(true);
                return;
            }

            this.selectedIndex = -1;
        });
    }

    function resetUsersSelect($form) {
        $form.find("select.js-task-users-select").each(function () {
            if (this.tomselect) {
                this.tomselect.clear(true);
                return;
            }

            this.selectedIndex = -1;
        });
    }

    function initCustomerTomSelects($scope) {
        if (typeof window.TomSelect === "undefined") {
            return;
        }

        $scope.find("select.js-task-customer-select").each(function () {
            if (this.tomselect) {
                return;
            }

            var createUrl = this.dataset.customerCreateUrl;

            new TomSelect(this, {
                dropdownParent: "body",
                render: {
                    option_create: function (data, escape) {
                        return '<div class="create">Ajouter <strong>' + escape(data.input) + '</strong>&hellip;</div>';
                    },
                    no_results: function (data, escape) {
                        return '<div class="no-results">Aucun resultat pour <strong>' + escape(data.input) + '</strong></div>';
                    }
                },
                create: function (input, callback) {
                    var customerName = String(input || "").trim();

                    if (customerName === "" || !createUrl) {
                        callback();
                        return;
                    }

                    $.ajax({
                        url: createUrl,
                        method: "POST",
                        contentType: "application/json",
                        dataType: "json",
                        data: JSON.stringify({ name: customerName }),
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    }).done(function (response) {
                        if (!response || !response.success || !response.id || !response.name) {
                            callback();
                            return;
                        }

                        callback({
                            value: String(response.id),
                            text: response.name
                        });
                    }).fail(function () {
                        callback();
                        alert("Impossible de creer le client pour le moment.");
                    });
                },
                persist: true,
                maxOptions: null,
                closeAfterSelect: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                onInitialize: function () {
                    var tom = this;
                    tom.control_input.addEventListener("keydown", function (event) {
                        var isPlainCharacter = event.key && event.key.length === 1 && !event.ctrlKey && !event.metaKey && !event.altKey;
                        if (!isPlainCharacter) {
                            return;
                        }

                        if (tom.items.length > 0) {
                            tom.clear(true);
                        }
                    });
                }
            });
        });
    }

    function initUsersTomSelects($scope) {
        if (typeof window.TomSelect === "undefined") {
            return;
        }

        $scope.find("select.js-task-users-select").each(function () {
            if (this.tomselect) {
                return;
            }

            new TomSelect(this, {
                dropdownParent: "body",
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
        });
    }

    function buildActionLink(action, taskId) {
        if (!action || !action.enabled) {
            return "";
        }

        var classNames = [];
        if (action.className) {
            classNames.push(escapeHtml(action.className));
        }
        if (action.inlineEdit) {
            classNames.push("js-inline-edit-toggle");
        }

        var classes = classNames.length > 0 ? ' class="' + classNames.join(" ") + '"' : "";
        var confirmAttr = action.confirm ? ' onclick="return confirm(\'' + escapeJsSingleQuote(action.confirm) + '\')"' : "";
        var href = action.inlineEdit ? "#" : replaceTaskId(action.urlTemplate, taskId);
        var content = "";
        var dataAttr = action.inlineEdit ? ' data-task-id="' + escapeHtml(taskId) + '"' : "";

        if (action.iconClass) {
            content = '<i class="' + escapeHtml(action.iconClass) + '"></i>';
        } else {
            var text = escapeHtml(action.text || "");
            content = action.wrapText ? "<span>" + text + "</span>" : text;
        }

        return '<a' + classes + ' href="' + href + '"' + dataAttr + confirmAttr + '>' + content + "</a>";
    }

    function buildActionsCell(config, taskId) {
        if (!config.hasActions) {
            return "";
        }

        var actionParts = (config.actions || [])
            .map(function (action) { return buildActionLink(action, taskId); })
            .filter(function (html) { return html !== ""; });

        return '<td><div style="display:inline-flex;align-items:center;column-gap:8px;">' + actionParts.join("") + "</div></td>";
    }

    function buildDoneCell(config, taskId) {
        if (!config.hasDone) {
            return "";
        }

        return '<td class="form-switch"><input type="checkbox" id="taskdone_' + escapeHtml(taskId) + '" class="taskdone" data-taskdone="' + escapeHtml(taskId) + '"></td>';
    }

    function buildTaskRowHtml(config, responseTask) {
        var id = responseTask.id;
        var users = (responseTask.users || []).map(function (user) {
            return escapeHtml(user) + "<br>";
        }).join("");

        return [
            '<tr data-taskdone="' + escapeHtml(id) + '">',
            '<td class="d-none">' + escapeHtml(id) + "</td>",
            '<td class="color-white text-bold">' + escapeHtml(responseTask.customer) + "</td>",
            '<td class="color-white text-bold">' + escapeHtml(responseTask.subject) + "</td>",
            '<td class="color-white text-bold">' + users + "</td>",
            '<td class="color-white text-bold">' + escapeHtml(responseTask.deadline_display || "") + "</td>",
            '<td class="color-white text-bold">' + escapeHtml(responseTask.note || "") + "</td>",
            buildActionsCell(config, id),
            buildDoneCell(config, id),
            "</tr>"
        ].join("");
    }

    function bindInlineAdd(formElement, config) {
        var $form = $(formElement);
        var $inlineRow = $(config.rowSelector);
        var $errorRow = $(config.errorRowSelector);

        $form.on("submit", function (e) {
            e.preventDefault();

            var $errorBox = $errorRow.find(".message-error");

            $.ajax({
                url: config.submitUrl,
                method: "POST",
                data: $form.serialize(),
                dataType: "json",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).done(function (response) {
                if (!response.success || !response.task) {
                    return;
                }

                var rowHtml = buildTaskRowHtml(config, response.task);
                $errorRow.after(rowHtml);
                $errorBox.empty();
                $errorRow.addClass("d-none");
                $form.trigger("reset");
                resetCustomerSelect($form);
                resetUsersSelect($form);
                $inlineRow.addClass("d-none");
                window.dispatchEvent(new Event("task-live-local-change"));
            }).fail(function (xhr) {
                var errors = xhr.responseJSON && Array.isArray(xhr.responseJSON.errors)
                    ? xhr.responseJSON.errors
                    : ["Une erreur est survenue."];

                $errorBox.html(errors.map(function (msg) {
                    return "<div>" + escapeHtml(msg) + "</div>";
                }).join(""));

                $errorRow.removeClass("d-none");
                $inlineRow.removeClass("d-none");
            });
        });
    }

    function bindReorder(reorderUrl) {
        if (!reorderUrl || window.__taskInlineReorderBound) {
            return;
        }

        window.__taskInlineReorderBound = true;

        $("#tableOrderTaskP1, #tableOrderTaskP2").on("reorder-row.bs.table", function (e, table) {
            $.ajax({
                url: reorderUrl,
                method: "POST",
                data: {
                    table: JSON.stringify(table),
                    context: 1
                },
                dataType: "JSON"
            }).done(function () {
                window.dispatchEvent(new Event("task-live-local-change"));
            });
        });

        $("#tableOrderAppointment").on("reorder-row.bs.table", function (e, table) {
            $.ajax({
                url: reorderUrl,
                method: "POST",
                data: {
                    table: JSON.stringify(table),
                    context: 2
                },
                dataType: "JSON"
            }).done(function () {
                window.dispatchEvent(new Event("task-live-local-change"));
            });
        });

        $("#tableOrderQuote").on("reorder-row.bs.table", function (e, table) {
            $.ajax({
                url: reorderUrl,
                method: "POST",
                data: {
                    table: JSON.stringify(table),
                    context: 3
                },
                dataType: "JSON"
            }).done(function () {
                window.dispatchEvent(new Event("task-live-local-change"));
            });
        });
    }

    $(function () {
        $(document).on("click", ".js-inline-add-toggle", function (e) {
            e.preventDefault();
            var target = $(this).data("target");
            $(target).removeClass("d-none").show();
        });

        $(document).on("click", ".js-inline-add-cancel", function () {
            var target = $(this).data("target");
            $(target).hide().addClass("d-none");
        });

        // Useful outside task pages too (appointment inline add uses this class).
        initUsersTomSelects($(document));

        var $forms = $("form[data-task-inline-config]");
        if ($forms.length === 0) {
            return;
        }

        initCustomerTomSelects($(document));

        $forms.each(function () {
            var rawConfig = $(this).attr("data-task-inline-config");
            if (!rawConfig) {
                return;
            }

            try {
                var decodedConfig = decodeHtml(rawConfig);
                var config = JSON.parse(decodedConfig);
                bindInlineAdd(this, config);
                bindReorder(config.reorderUrl);
            } catch (error) {
                console.error("Config inline task invalide", error);
            }
        });
    });
})(jQuery);
