(function ($) {
    "use strict";

    function escapeHtml(value) {
        return $("<div>").text(value ?? "").html();
    }

    function initials(value) {
        var text = String(value || "").trim();
        if (text === "") {
            return "?";
        }

        return text.charAt(0).toUpperCase();
    }

    function normalizeAvatarPath(path) {
        var value = String(path || "").trim();
        if (value === "") {
            return "";
        }

        if (value.indexOf("http://") === 0 || value.indexOf("https://") === 0 || value.indexOf("/") === 0) {
            return value;
        }

        return "/" + value;
    }

    function replaceId(urlTemplate, id) {
        return String(urlTemplate || "").replace("IDEA_ID", String(id || ""));
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

    function parseJsonObject(value) {
        var raw = String(value || "").trim();
        if (raw === "") {
            return {};
        }

        try {
            var parsed = JSON.parse(raw);
            if (parsed && typeof parsed === "object" && !Array.isArray(parsed)) {
                return parsed;
            }
        } catch (error) {
            return {};
        }

        return {};
    }

    function setMultiValue($select, values) {
        if ($select.length === 0) {
            return;
        }

        var ids = (values || []).map(function (id) {
            return String(id || "");
        }).filter(function (id) {
            return id !== "";
        });

        var element = $select.get(0);
        if (element.tomselect) {
            element.tomselect.clear(true);

            ids.forEach(function (id) {
                if (!Object.prototype.hasOwnProperty.call(element.tomselect.options, id)) {
                    element.tomselect.addOption({ value: id, text: id });
                }
            });

            element.tomselect.setValue(ids, true);
            element.tomselect.refreshItems();
            return;
        }

        $select.val(ids);
    }

    function getMultiValue($select) {
        if ($select.length === 0) {
            return [];
        }

        var element = $select.get(0);
        if (element.tomselect) {
            var value = element.tomselect.getValue();
            if (Array.isArray(value)) {
                return value;
            }

            if (typeof value === "string" && value !== "") {
                return value.split(",").map(function (id) {
                    return String(id || "").trim();
                }).filter(function (id) {
                    return id !== "";
                });
            }

            return [];
        }

        var raw = $select.val();
        if (Array.isArray(raw)) {
            return raw;
        }

        if (typeof raw === "string" && raw !== "") {
            return [raw];
        }

        return [];
    }

    function selectedPersonsFromEditor($select, profileMap) {
        var ids = getMultiValue($select);
        var element = $select.get(0);

        if (!element || !element.tomselect) {
            return [];
        }

        return ids.map(function (id) {
            var option = element.tomselect.options[id] || null;
            var name = option && option.text ? String(option.text) : "";
            return {
                id: Number.parseInt(id, 10) || 0,
                firstname: name,
                profile_picture: String((profileMap || {})[id] || "")
            };
        }).filter(function (person) {
            return person.firstname !== "";
        });
    }

    function initUsersTomSelect($row) {
        if (typeof window.TomSelect === "undefined") {
            return;
        }

        var usersSelect = $row.find("select.js-inline-edit-ideabam-users").get(0);
        if (usersSelect && !usersSelect.tomselect) {
            new TomSelect(usersSelect, {
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
        }
    }

    function renderPersonsCell(idea, profileMap) {
        var persons = Array.isArray(idea.person) ? idea.person : [];

        if (persons.length === 0) {
            return "";
        }

        var chips = persons.map(function (person) {
            var name = "";
            var profilePicture = "";
            if (typeof person === "string") {
                name = person;
            } else if (person && typeof person === "object") {
                name = String(person.firstname || "");
                profilePicture = String(person.profile_picture || person.profilePicture || "");
                var personId = String(person.id || "");
                if (profilePicture === "" && personId !== "") {
                    profilePicture = String((profileMap || {})[personId] || "");
                }
            }

            var safeName = escapeHtml(name);
            var title = safeName !== "" ? ' title="' + safeName + '"' : "";

            if (String(profilePicture).trim() !== "") {
                return '<span class="team-user-chip"' + title + '><img class="team-user-avatar" src="' + escapeHtml(normalizeAvatarPath(profilePicture)) + '" alt="' + safeName + '"></span>';
            }

            return '<span class="team-user-chip"' + title + '><span class="team-user-fallback">' + escapeHtml(initials(name)) + "</span></span>";
        });

        return '<div class="team-users-stack">' + chips.join("") + "</div>";
    }

    function bindIdeabamInlineEdit() {
        var cfg = window.ideabamInlineEditConfig || {};
        var updateUrlTemplate = cfg.updateUrlTemplate;
        var rowSelector = cfg.rowSelector || "#inlineEditIdeabamRow";
        var errorSelector = cfg.errorRowSelector || "#inlineEditIdeabamErrors";

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
                $("tr[data-ideabam-id='" + sourceId + "']").removeClass("d-none");
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

            var $sourceRow = $("tr[data-ideabam-id='" + rowId + "']").first();
            if ($sourceRow.length === 0) {
                return;
            }

            closeEditor();

            $editRow.find(".js-inline-edit-ideabam-subject").val(String($sourceRow.attr("data-subject") || ""));
            $editRow.find(".js-inline-edit-ideabam-object").val(String($sourceRow.attr("data-object") || ""));
            var personIds = splitIds($sourceRow.attr("data-person-ids"));
            setMultiValue($editRow.find(".js-inline-edit-ideabam-users"), personIds);

            var currentProfileMap = {};
            var avatarImages = $sourceRow.children("td").eq(2).find("img.team-user-avatar");
            personIds.forEach(function (id, index) {
                var img = avatarImages.get(index);
                if (!img) {
                    return;
                }

                var src = String(img.getAttribute("src") || "").trim();
                if (src !== "") {
                    currentProfileMap[String(id)] = src;
                }
            });

            $editRow.data("currentProfileMap", currentProfileMap);

            $sourceRow.after($editRow);
            $editRow.after($errorRow);
            $sourceRow.addClass("d-none");
            $editRow.removeClass("d-none");
            $editRow.attr("data-source-id", rowId);
            clearError();
        }

        $(document).on("click", ".js-inline-edit-ideabam-toggle", function (e) {
            e.preventDefault();
            openEditor($(this).data("id"));
        });

        $(document).on("click", ".js-inline-edit-ideabam-cancel", function () {
            closeEditor();
        });

        $(document).on("click", ".js-inline-edit-ideabam-save", function () {
            var rowId = String($editRow.attr("data-source-id") || "");
            if (rowId === "") {
                return;
            }

            var payload = {
                subject: String($editRow.find(".js-inline-edit-ideabam-subject").val() || ""),
                object: String($editRow.find(".js-inline-edit-ideabam-object").val() || ""),
                person_ids: getMultiValue($editRow.find(".js-inline-edit-ideabam-users"))
            };

            $.ajax({
                url: replaceId(updateUrlTemplate, rowId),
                method: "POST",
                dataType: "json",
                data: payload,
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).done(function (response) {
                if (!response || !response.success || !response.idea) {
                    showError(["Mise a jour impossible."]);
                    return;
                }

                var idea = response.idea;
                var $sourceRow = $("tr[data-ideabam-id='" + rowId + "']").first();
                if ($sourceRow.length === 0) {
                    closeEditor();
                    return;
                }

                var existingProfileMap = parseJsonObject($sourceRow.attr("data-person-profiles"));
                var currentProfileMap = $editRow.data("currentProfileMap") || {};
                var mergedProfileMap = Object.assign({}, existingProfileMap, currentProfileMap);

                if (Array.isArray(idea.person)) {
                    idea.person.forEach(function (person) {
                        if (!person || typeof person !== "object") {
                            return;
                        }

                        var pid = String(person.id || "");
                        if (pid === "") {
                            return;
                        }

                        var pfp = String(person.profile_picture || person.profilePicture || "");
                        if (pfp !== "") {
                            mergedProfileMap[pid] = pfp;
                        }
                    });
                }

                if (!Array.isArray(idea.person) || idea.person.length === 0) {
                    idea.person = selectedPersonsFromEditor($editRow.find(".js-inline-edit-ideabam-users"), mergedProfileMap);
                }

                if (!Array.isArray(idea.person_ids) || idea.person_ids.length === 0) {
                    idea.person_ids = payload.person_ids;
                }

                $sourceRow.attr("data-subject", String(idea.subject || ""));
                $sourceRow.attr("data-object", String(idea.object || ""));
                $sourceRow.attr("data-person-ids", Array.isArray(idea.person_ids) ? idea.person_ids.join(",") : "");
                $sourceRow.attr("data-person-profiles", JSON.stringify(mergedProfileMap));

                $sourceRow.children("td").eq(0).text(String(idea.subject || ""));
                $sourceRow.children("td").eq(1).text(String(idea.object || ""));
                $sourceRow.children("td").eq(2).html(renderPersonsCell(idea, mergedProfileMap));

                closeEditor();
            }).fail(function (xhr) {
                var errors = xhr.responseJSON && Array.isArray(xhr.responseJSON.errors)
                    ? xhr.responseJSON.errors
                    : ["Une erreur est survenue."];
                showError(errors);
            });
        });
    }

    $(bindIdeabamInlineEdit);
})(jQuery);
