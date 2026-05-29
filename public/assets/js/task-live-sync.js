(function ($) {
    "use strict";

    if (window.__taskLiveSyncStarted) {
        return;
    }

    window.__taskLiveSyncStarted = true;
    window.__taskLiveNotificationTimer = null;
    window.__taskLiveTabId = window.sessionStorage.getItem("task-live-tab-id");
    if (!window.__taskLiveTabId) {
        window.__taskLiveTabId = "tab_" + Math.random().toString(36).slice(2) + Date.now().toString(36);
        window.sessionStorage.setItem("task-live-tab-id", window.__taskLiveTabId);
    }

    var draftContexts = {};

    function scheduleRemoteDraftExpiry(scope) {
        var key = String(scope || "");
        if (!key) {
            return;
        }

        if (!draftContexts[key]) {
            draftContexts[key] = {};
        }

        if (draftContexts[key].remoteTimer) {
            window.clearTimeout(draftContexts[key].remoteTimer);
        }

        draftContexts[key].remoteTimer = window.setTimeout(function () {
            clearRemoteDraftRow(key);
        }, 20000);
    }

    function hasTaskTableOnPage() {
        return $("#tableOrderTaskP1, #tableOrderTaskP2").length > 0;
    }

    function decodeHtml(value) {
        return $("<textarea>").html(value || "").text();
    }

    function shouldRunSync() {
        return (Boolean(window.taskLiveStreamUrl) || Boolean(window.taskLiveVersionUrl)) && hasTaskTableOnPage();
    }

    function getActiveTableSelector() {
        if ($("#tableOrderTaskP1").length > 0) {
            return "#tableOrderTaskP1";
        }

        if ($("#tableOrderTaskP2").length > 0) {
            return "#tableOrderTaskP2";
        }

        return null;
    }

    function getDraftRowSelectorForPage() {
        var candidates = [
            "#inlineAddTaskP1Row",
            "#inlineAddTaskP2Row",
            "#inlineAddTaskNwP1Row",
            "#inlineAddTaskNwP2Row"
        ];

        for (var i = 0; i < candidates.length; i += 1) {
            if ($(candidates[i]).length > 0) {
                return candidates[i];
            }
        }

        return null;
    }

    function actionLabel(action) {
        if (action === "created") {
            return "ajoutée";
        }

        if (action === "deleted") {
            return "supprimée";
        }

        return "modiféee";
    }

    function getContextLabelFromPathname() {
        var pathname = String(window.location.pathname || "").toLowerCase();

        if (pathname.indexOf("/semaine-actuelle/p2") === 0) {
            return "Semaine actuelle - P2";
        }

        if (pathname.indexOf("/semaine-actuelle/p1") === 0) {
            return "Semaine actuelle - P1";
        }

        if (pathname.indexOf("/semaine-suivante/p2") === 0) {
            return "Semaine suivante - P2";
        }

        if (pathname.indexOf("/semaine-suivante/p1") === 0) {
            return "Semaine suivante - P1";
        }

        if (pathname.indexOf("/semaine-actuelle/rendez-vous") === 0) {
            return "Semaine actuelle - Rendez-vous";
        }

        if (pathname.indexOf("/semaine-suivante/rendez-vous") === 0) {
            return "Semaine suivante - Rendez-vous";
        }

        return "";
    }

    function buildInitials(actor) {
        var first = actor && actor.firstname ? String(actor.firstname).charAt(0).toUpperCase() : "?";
        var last = actor && actor.lastname ? String(actor.lastname).charAt(0).toUpperCase() : "";

        return first + last;
    }

    function getInlineAddContext() {
        var $form = $("form[data-task-inline-config]").first();
        if ($form.length === 0) {
            return null;
        }

        var rawConfig = $form.attr("data-task-inline-config");
        if (!rawConfig) {
            return null;
        }

        try {
            var config = JSON.parse(decodeHtml(rawConfig));

            return {
                $form: $form,
                config: config
            };
        } catch (error) {
            console.error("Config inline task invalide", error);
            return null;
        }
    }

    function getDraftScopeForPage() {
        var explicitScope = getDraftRowSelectorForPage();
        if (explicitScope) {
            return explicitScope;
        }

        var tableSelector = getActiveTableSelector();
        if (tableSelector === "#tableOrderTaskP1") {
            return "#inlineAddTaskP1Row";
        }

        if (tableSelector === "#tableOrderTaskP2") {
            return "#inlineAddTaskP2Row";
        }

        return null;
    }

    function ensureRemoteInlineRow(scope) {
        var $row = $(scope);
        if ($row.length > 0) {
            return $row;
        }

        var tableSelector = getActiveTableSelector();
        if (!tableSelector) {
            return $();
        }

        var $tbody = $(tableSelector + " tbody").first();
        if ($tbody.length === 0) {
            return $();
        }

        var rowId = String(scope || "").replace(/^#/, "");
        var rowHtml = '' +
            '<tr id="' + escapeHtml(rowId) + '" class="bg-blue-dark-light" data-live-synthetic="1">' +
                '<td class="d-none"></td>' +
                '<td><input type="text" class="form-control form-control-sm js-live-remote-customer" disabled></td>' +
                '<td><input type="text" class="form-control form-control-sm js-live-remote-subject" disabled></td>' +
                '<td><input type="text" class="form-control form-control-sm js-live-remote-users" disabled></td>' +
                '<td><input type="text" class="form-control form-control-sm js-live-remote-deadline" disabled></td>' +
                '<td><input type="text" class="form-control form-control-sm js-live-remote-note" disabled></td>' +
            '</tr>';

        $tbody.prepend(rowHtml);
        return $(scope);
    }

    function isLocalInlineRowBusy(scope) {
        var $row = $(String(scope || ""));
        if ($row.length === 0) {
            return false;
        }

        if ($row.attr("data-live-local-editing") === "1") {
            return true;
        }

        return $row.find(":focus").length > 0;
    }

    function getFormValue($form, selector) {
        var $field = $form.find(selector).first();
        if ($field.length === 0) {
            return "";
        }

        return String($field.val() || "").trim();
    }

    function getSelectedText($form, selector, multiple) {
        var $field = $form.find(selector).first();
        if ($field.length === 0) {
            return multiple ? [] : "";
        }

        if (multiple) {
            return $field.find("option:selected").map(function () {
                return String($(this).text() || "").trim();
            }).get().filter(function (value) {
                return value !== "";
            });
        }

        var $option = $field.find("option:selected").first();
        return $option.length ? String($option.text() || "").trim() : "";
    }

    function formatDraftDeadline(value) {
        if (!value) {
            return "";
        }

        var date = new Date(value);
        if (Number.isNaN(date.getTime())) {
            return String(value);
        }

        var day = String(date.getDate()).padStart(2, "0");
        var month = String(date.getMonth() + 1).padStart(2, "0");
        var year = date.getFullYear();
        var hours = String(date.getHours()).padStart(2, "0");
        var minutes = String(date.getMinutes()).padStart(2, "0");

        return day + "/" + month + "/" + year + " " + hours + ":" + minutes;
    }

    function buildDraftPayload($form) {
        return {
            customer: getSelectedText($form, "select.js-task-customer-select"),
            subject: getFormValue($form, "input[name$='[object]']"),
            subobject1: getFormValue($form, "input[name$='[subobject1]']"),
            subobject2: getFormValue($form, "input[name$='[subobject2]']"),
            subobject3: getFormValue($form, "input[name$='[subobject3]']"),
            users: getSelectedText($form, "select.js-task-users-select", true),
            deadline_value: getFormValue($form, "input[name$='[deadline]']"),
            deadline_display: formatDraftDeadline(getFormValue($form, "input[name$='[deadline]']")),
            note: getFormValue($form, "textarea[name$='[note]'], input[name$='[note]']"),
            visible: !$form.find("tr").first().hasClass("d-none")
        };
    }

    function setSingleSelectByText($select, text) {
        if (!$select || $select.length === 0) {
            return;
        }

        var target = String(text || "").trim().toLowerCase();
        if (target === "") {
            if ($select[0].tomselect) {
                $select[0].tomselect.clear(true);
            } else {
                $select.val("");
            }
            return;
        }

        var matchedValue = "";
        $select.find("option").each(function () {
            if (String($(this).text() || "").trim().toLowerCase() === target) {
                matchedValue = String($(this).attr("value") || "");
                return false;
            }

            return true;
        });

        if ($select[0].tomselect) {
            $select[0].tomselect.clear(true);
            if (matchedValue !== "") {
                $select[0].tomselect.addItem(matchedValue, true);
            }
            return;
        }

        $select.val(matchedValue);
    }

    function setMultiSelectByText($select, values) {
        if (!$select || $select.length === 0) {
            return;
        }

        var wanted = Array.isArray(values)
            ? values.map(function (value) { return String(value || "").trim().toLowerCase(); }).filter(function (value) { return value !== ""; })
            : [];

        var matchedValues = [];
        $select.find("option").each(function () {
            var label = String($(this).text() || "").trim().toLowerCase();
            if (wanted.indexOf(label) !== -1) {
                matchedValues.push(String($(this).attr("value") || ""));
            }
        });

        if ($select[0].tomselect) {
            $select[0].tomselect.clear(true);
            matchedValues.forEach(function (value) {
                if (value !== "") {
                    $select[0].tomselect.addItem(value, true);
                }
            });
            return;
        }

        $select.val(matchedValues);
    }

    function renderDraftActorBadge($row, actor, actorName) {
        if (!$row || $row.length === 0) {
            return;
        }

        var scope = String($row.attr("id") || "");
        if (!scope) {
            return;
        }

        var $table = $row.closest("table");
        if ($table.length === 0) {
            return;
        }

        var tableOffset = $table.offset();
        var rowOffset = $row.offset();
        if (!tableOffset || !rowOffset) {
            return;
        }

        var badgeSelector = '.js-live-draft-avatar[data-scope="' + escapeHtml(scope) + '"]';
        var $badge = $(badgeSelector).first();
        if ($badge.length === 0) {
            $badge = $('<div class="js-live-draft-avatar" aria-hidden="true"></div>');
            $badge.attr("data-scope", scope);
            $(document.body).append($badge);
        }

        var badgeSize = 34;
        var top = rowOffset.top + ($row.outerHeight() / 2) - (badgeSize / 2);
        var left = tableOffset.left - 44;

        $badge.css({
            position: "absolute",
            left: left + "px",
            top: top + "px",
            width: badgeSize + "px",
            height: badgeSize + "px",
            borderRadius: "50%",
            border: "2px solid #f3c441",
            boxShadow: "0 2px 10px rgba(0, 0, 0, .28)",
            overflow: "hidden",
            display: "inline-flex",
            alignItems: "center",
            justifyContent: "center",
            background: "#31465f",
            zIndex: "30",
            pointerEvents: "none"
        });

        $badge.attr("title", (actorName || "Quelqu'un") + " ajoute une tache");
        $badge.empty();

        function renderFallback() {
            $badge.empty();
            var $fallback = $('<span></span>');
            $fallback.text(buildInitials(actor));
            $fallback.css({
                color: "#ffffff",
                fontSize: "12px",
                fontWeight: "700",
                lineHeight: "1"
            });
            $badge.append($fallback);
        }

        if (actor && actor.profile_picture_url) {
            var $img = $('<img alt="avatar">');
            $img.attr("src", String(actor.profile_picture_url));
            $img.css({
                width: "100%",
                height: "100%",
                objectFit: "cover"
            });
            $img.on("error", function () {
                renderFallback();
            });
            $badge.append($img);
            return;
        }

        renderFallback();
    }

    function setRowLockedState($row, locked) {
        if (!$row || $row.length === 0) {
            return;
        }

        $row.find("input, textarea, select, button").prop("disabled", !!locked);

        $row.find("select").each(function () {
            if (!this.tomselect) {
                return;
            }

            if (locked) {
                this.tomselect.blur();
                this.tomselect.close();
                this.tomselect.disable();
                return;
            }

            this.tomselect.enable();
        });
    }

    function applyDraftToInlineRow(payload) {
        var draftState = (payload && payload.draft) || {};
        var draft = draftState.draft || draftState;
        var actor = draftState.actor || {};
        var actorName = [actor.firstname || "Quelqu'un", actor.lastname || ""].join(" ").trim();
        var scope = String(payload.scope || getDraftRowSelectorForPage() || "");
        if (!scope) {
            return;
        }

        var $row = $(scope);
        if ($row.length === 0) {
            $row = ensureRemoteInlineRow(scope);
            if ($row.length === 0) {
                return;
            }
        }

        var customer = draft.customer || "";
        var subject = draft.subject || "";
        var deadlineValue = draft.deadline_value || "";
        var note = draft.note || "";

        if ($row.attr("data-live-synthetic") !== "1" && $row.hasClass("d-none")) {
            $row.attr("data-live-was-hidden", "1");
        }

        $row.removeClass("d-none");
        $row.attr("data-live-remote-draft", "1");
        $row.attr("data-live-remote-scope", scope);
        $row.css("outline", "1px dashed rgba(243,196,65,.7)");
        scheduleRemoteDraftExpiry(scope);

        // Cote observateur: on retire les actions pour eviter toute confusion.
        $row.find("button").addClass("d-none");

        if ($row.find("select.js-task-customer-select").length > 0) {
            setSingleSelectByText($row.find("select.js-task-customer-select").first(), customer);
        } else {
            $row.find(".js-live-remote-customer").val(customer);
        }

        if ($row.find("select.js-task-users-select").length > 0) {
            setMultiSelectByText($row.find("select.js-task-users-select").first(), draft.users || []);
        } else {
            $row.find(".js-live-remote-users").val(Array.isArray(draft.users) ? draft.users.join(", ") : "");
        }

        if ($row.find("input[name$='[object]']").length > 0) {
            $row.find("input[name$='[object]']").val(subject);
        } else {
            $row.find(".js-live-remote-subject").val(subject);
        }

        if ($row.find("input[name$='[deadline]']").length > 0) {
            $row.find("input[name$='[deadline]']").val(deadlineValue);
        } else {
            $row.find(".js-live-remote-deadline").val(draft.deadline_display || "");
        }

        if ($row.find("textarea[name$='[note]'], input[name$='[note]']").length > 0) {
            $row.find("textarea[name$='[note]'], input[name$='[note]']").val(note);
        } else {
            $row.find(".js-live-remote-note").val(note);
        }

        renderDraftActorBadge($row, actor, actorName);

        setRowLockedState($row, true);
    }

    function escapeHtml(value) {
        return $("<div>").text(value ?? "").html();
    }

    function clearRemoteDraftRow(scope) {
        var $row = $(String(scope || ""));
        if ($row.length === 0) {
            return;
        }

        var key = String(scope || "");
        var ctx = draftContexts[key] || null;
        if (ctx && ctx.remoteTimer) {
            window.clearTimeout(ctx.remoteTimer);
            ctx.remoteTimer = null;
        }

        if ($row.attr("data-live-remote-draft") !== "1") {
            return;
        }

        if ($row.attr("data-live-synthetic") === "1") {
            $row.remove();
            return;
        }

        var wasHidden = $row.attr("data-live-was-hidden") === "1";

        $row.removeAttr("data-live-remote-draft");
        $row.removeAttr("data-live-remote-scope");
        $row.removeAttr("data-live-was-hidden");
        $row.css("outline", "");
        $('.js-live-draft-avatar[data-scope="' + escapeHtml($row.attr("id") || "") + '"]').remove();
        $row.find("button").removeClass("d-none");
        setRowLockedState($row, false);

        if ($row.attr("data-live-synthetic") === "1") {
            $row.remove();
            return;
        }

        if (wasHidden && !isLocalInlineRowBusy(scope)) {
            $row.find("input[type='text'], input[type='datetime-local'], textarea").val("");
            $row.find("select").each(function () {
                if (this.tomselect) {
                    this.tomselect.clear(true);
                } else {
                    this.selectedIndex = -1;
                }
            });
            $row.addClass("d-none");
        }
    }

    function handleDraftPayload(response) {
        if (!response || typeof response.draft_version === "undefined") {
            return;
        }

        var nextVersion = Number(response.draft_version) || 0;
        var currentDraftVersion = Number(window.__taskLiveDraftVersion || 0);

        if (currentDraftVersion === 0) {
            window.__taskLiveDraftVersion = Math.max(0, nextVersion - 1);
        }

        if (nextVersion <= Number(window.__taskLiveDraftVersion || 0)) {
            return;
        }

        window.__taskLiveDraftVersion = nextVersion;

        var activeScope = getDraftScopeForPage();
        if (!activeScope) {
            return;
        }

        if (response.drafts && typeof response.drafts === "object") {
            var activeDraft = response.drafts[activeScope] || null;
            if (!activeDraft) {
                clearRemoteDraftRow(activeScope);
                return;
            }

            if (activeDraft.tab_id && String(activeDraft.tab_id) === String(window.__taskLiveTabId)) {
                clearRemoteDraftRow(activeScope);
                return;
            }

            applyDraftToInlineRow({
                scope: activeScope,
                draft: activeDraft
            });

            return;
        }

        if (response.scope && String(response.scope) !== activeScope) {
            return;
        }

        var draft = response.draft || null;
        if (!draft) {
            clearRemoteDraftRow(activeScope);
            return;
        }

        if (draft.tab_id && String(draft.tab_id) === String(window.__taskLiveTabId)) {
            clearRemoteDraftRow(activeScope);
            return;
        }

        applyDraftToInlineRow({
            scope: activeScope,
            draft: draft
        });
    }

    function handleDraftClear(response) {
        if (!response) {
            return;
        }

        var activeScope = getDraftScopeForPage();
        if (!activeScope) {
            return;
        }

        if (response.scope && String(response.scope) !== activeScope) {
            return;
        }

        clearRemoteDraftRow(activeScope);
    }

    function postDraftState($form, config) {
        if (!window.taskLiveDraftUrl || !$form || !$form.length) {
            return;
        }

        var payload = {
            scope: config.rowSelector,
            tab_id: window.__taskLiveTabId,
            draft: buildDraftPayload($form)
        };

        $.ajax({
            url: window.taskLiveDraftUrl,
            method: "POST",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify(payload),
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        });
    }

    function requestDraftClear(config, useKeepalive) {
        if (!window.taskLiveDraftUrl || !config || !config.rowSelector) {
            return;
        }

        var payload = {
            scope: config.rowSelector,
            tab_id: window.__taskLiveTabId
        };

        if (useKeepalive && window.fetch) {
            try {
                window.fetch(window.taskLiveDraftUrl, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    credentials: "same-origin",
                    keepalive: true,
                    body: JSON.stringify(payload)
                });
                return;
            } catch (error) {
                // Fallback jQuery plus bas.
            }
        }

        $.ajax({
            url: window.taskLiveDraftUrl,
            method: "DELETE",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify(payload),
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        });
    }

    function clearDraftState($form, config) {
        if (!window.taskLiveDraftUrl || !$form || !$form.length) {
            return;
        }

        requestDraftClear(config, false);

        clearRemoteDraftRow(config.rowSelector);
    }

    function bindDraftSync($form, config) {
        if (!$form || !$form.length || !config || !config.rowSelector || !window.taskLiveDraftUrl) {
            return;
        }

        var draftTimer = null;
        var heartbeatTimer = null;
        var hasLocalDraft = false;

        function isFormVisible() {
            var $row = $(config.rowSelector);
            return $row.length > 0 && !$row.hasClass("d-none");
        }

        function markLocalEditing(active) {
            var $row = $(config.rowSelector);
            if ($row.length === 0) {
                return;
            }

            $row.attr("data-live-local-editing", active ? "1" : "0");
        }

        function syncDraft() {
            if (!isFormVisible()) {
                if (hasLocalDraft) {
                    clearDraftState($form, config);
                    hasLocalDraft = false;
                }
                return;
            }

            hasLocalDraft = true;
            postDraftState($form, config);
        }

        function scheduleDraftSync() {
            if (draftTimer) {
                window.clearTimeout(draftTimer);
            }

            draftTimer = window.setTimeout(syncDraft, 350);
        }

        function startHeartbeat() {
            if (heartbeatTimer) {
                return;
            }

            heartbeatTimer = window.setInterval(function () {
                if (!isFormVisible()) {
                    return;
                }

                syncDraft();
            }, 10000);
        }

        function stopHeartbeat() {
            if (!heartbeatTimer) {
                return;
            }

            window.clearInterval(heartbeatTimer);
            heartbeatTimer = null;
        }

        function clearDraftOnPageExit() {
            if (!isFormVisible() && !hasLocalDraft) {
                return;
            }

            requestDraftClear(config, true);
        }

        // Nettoie un brouillon stale du meme onglet apres refresh.
        requestDraftClear(config, false);

        window.addEventListener("pagehide", clearDraftOnPageExit);
        window.addEventListener("beforeunload", clearDraftOnPageExit);

        $form.on("input change", "input, textarea, select", function () {
            markLocalEditing(true);
            scheduleDraftSync();
            startHeartbeat();
        });

        $form.on("focusin", "input, textarea, select", function () {
            markLocalEditing(true);
            startHeartbeat();
        });

        $form.on("focusout", "input, textarea, select", function () {
            if (isFormVisible()) {
                scheduleDraftSync();
            }
        });

        $(document).on("click", ".js-inline-add-cancel", function () {
            if ($(this).data("target") === config.rowSelector) {
                hasLocalDraft = false;
                markLocalEditing(false);
                stopHeartbeat();
                clearDraftState($form, config);
            }
        });

        window.addEventListener("task-live-local-change", function () {
            if (!isFormVisible() && hasLocalDraft) {
                hasLocalDraft = false;
                markLocalEditing(false);
                stopHeartbeat();
                clearDraftState($form, config);
            }
        });

        $form.on("submit", function () {
            markLocalEditing(false);
            if (isFormVisible()) {
                scheduleDraftSync();
            }
        });
    }

    function showLiveNotification(change) {
        var actor = (change && change.actor) || {};
        var actorName = [actor.firstname || "Quelqu'un", actor.lastname || ""].join(" ").trim();
        var action = actionLabel(change && change.action);
        var subject = change && (change.task_subject || change.entity_subject) ? String(change.task_subject || change.entity_subject) : "";
        var entityLabel = change && change.entity_label ? String(change.entity_label) : "";
        var contextLabel = change && change.context_label ? String(change.context_label) : "";
        if (!contextLabel) {
            contextLabel = getContextLabelFromPathname();
        }

        var box = document.getElementById("task-live-notification");
        if (!box) {
            box = document.createElement("div");
            box.id = "task-live-notification";
            box.style.position = "fixed";
            box.style.right = "16px";
            box.style.bottom = "16px";
            box.style.zIndex = "9999";
            box.style.background = "#13263a";
            box.style.color = "#ffffff";
            box.style.border = "1px solid #f3c441";
            box.style.borderRadius = "12px";
            box.style.padding = "12px 14px";
            box.style.display = "flex";
            box.style.alignItems = "center";
            box.style.columnGap = "10px";
            box.style.maxWidth = "340px";
            box.style.boxShadow = "0 8px 28px rgba(0,0,0,.35)";
            document.body.appendChild(box);
        }

        var avatarHtml = actor.profile_picture_url
            ? '<img src="' + actor.profile_picture_url + '" alt="avatar" style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid #f3c441;">'
            : '<span style="display:inline-flex;width:40px;height:40px;border-radius:50%;align-items:center;justify-content:center;background:#31465f;color:#fff;font-weight:700;">' + buildInitials(actor) + "</span>";

        var safeActorName = $("<div>").text(actorName).html();
        var safeSubject = $("<div>").text(subject).html();
        var safeEntityLabel = $("<div>").text(entityLabel).html();
        var safeContextLabel = $("<div>").text(contextLabel).html();

        var entityAndSubject = "";
        if (safeEntityLabel) {
            entityAndSubject = safeEntityLabel;
        }
        if (safeSubject) {
            entityAndSubject += (entityAndSubject ? " : " : "") + safeSubject;
        }

        var notificationMessage = "";
        if (safeContextLabel && entityAndSubject) {
            notificationMessage = safeContextLabel + " - " + entityAndSubject + " " + action;
        } else if (safeContextLabel) {
            notificationMessage = safeContextLabel + " - " + action;
        } else if (entityAndSubject) {
            notificationMessage = entityAndSubject + " " + action;
        } else {
            notificationMessage = "Mise a jour";
        }

        box.innerHTML = '' +
            avatarHtml +
            '<div style="line-height:1.25">' +
                '<div style="font-weight:700;">' + safeActorName + '</div>' +
                '<div style="font-size:13px;color:#d5dfeb;">' + notificationMessage + '</div>' +
            '</div>';

        box.style.opacity = "1";
        box.style.transform = "translateY(0)";
        box.style.transition = "opacity .25s ease, transform .25s ease";

        if (window.__taskLiveNotificationTimer) {
            window.clearTimeout(window.__taskLiveNotificationTimer);
        }

        window.__taskLiveNotificationTimer = window.setTimeout(function () {
            box.style.opacity = "0";
            box.style.transform = "translateY(8px)";

            window.setTimeout(function () {
                if (box && box.parentNode) {
                    box.parentNode.removeChild(box);
                }
            }, 250);

            window.__taskLiveNotificationTimer = null;
        }, 10000);
    }

    function softRefreshTable() {
        var tableSelector = getActiveTableSelector();
        if (!tableSelector) {
            return;
        }

        $.ajax({
            url: window.location.pathname + window.location.search,
            method: "GET",
            dataType: "html",
            timeout: 8000
        }).done(function (html) {
            var $parsed = $("<div>").append($.parseHTML(html));
            var $newBody = $parsed.find(tableSelector + " tbody").first();
            var $currentBody = $(tableSelector + " tbody").first();

            if ($newBody.length === 0 || $currentBody.length === 0) {
                return;
            }

            $currentBody.html($newBody.html());
        });
    }

    function startLiveSync() {
        if (!shouldRunSync()) {
            return;
        }

        var currentVersion = null;
        var currentDraftVersion = null;
        var lastLocalMutationAt = 0;
        var source = null;
        var usingPollingFallback = false;

        var draftContext = getInlineAddContext();
        if (draftContext) {
            bindDraftSync(draftContext.$form, draftContext.config);
        }

        function markLocalMutation() {
            lastLocalMutationAt = Date.now();
        }

        window.addEventListener("task-live-local-change", markLocalMutation);

        function handlePayload(response) {
            if (response && typeof response.draft_version !== "undefined") {
                handleDraftPayload(response);
            }

            if (!response || typeof response.version === "undefined") {
                return;
            }

            var nextVersion = Number(response.version) || 0;

            if (currentVersion === null) {
                // Premiere trame recue: on la traite aussi pour ne pas rater la premiere modif distante.
                currentVersion = Math.max(0, nextVersion - 1);
            }

            if (nextVersion <= currentVersion) {
                return;
            }

            currentVersion = nextVersion;

            // Quand une vraie modif arrive, on purge le draft distant affiche localement.
            var activeScope = getDraftScopeForPage();
            if (activeScope) {
                clearRemoteDraftRow(activeScope);
            }

            var change = response.last_change || null;
            var actorId = change && change.actor ? Number(change.actor.id || 0) : 0;
            var currentUserId = Number(window.currentUserId || 0);

            if (Date.now() - lastLocalMutationAt < 4000) {
                return;
            }

            // L'auteur de l'action ne voit pas de popup, mais son autre onglet reste synchronise.
            if (!(actorId && currentUserId && actorId === currentUserId)) {
                showLiveNotification(change);
            }

            window.setTimeout(softRefreshTable, 350);
        }

        function startEventSource() {
            if (usingPollingFallback || typeof window.EventSource === "undefined" || !window.taskLiveStreamUrl) {
                return;
            }

            if (source) {
                source.close();
            }

            var consecutiveErrors = 0;
            var lastErrorAt = 0;

            source = new EventSource(window.taskLiveStreamUrl);

            source.onopen = function () {
                consecutiveErrors = 0;
            };

            source.addEventListener("task-update", function (event) {
                if (!event || !event.data) {
                    return;
                }

                try {
                    handlePayload(JSON.parse(event.data));
                } catch (error) {
                    console.error("Payload live invalide", error);
                }
            });

            source.addEventListener("task-draft", function (event) {
                if (!event || !event.data) {
                    return;
                }

                try {
                    handleDraftPayload(JSON.parse(event.data));
                } catch (error) {
                    console.error("Payload brouillon invalide", error);
                }
            });

            source.addEventListener("task-draft-clear", function (event) {
                if (!event || !event.data) {
                    return;
                }

                try {
                    handleDraftClear(JSON.parse(event.data));
                } catch (error) {
                    console.error("Payload brouillon invalide", error);
                }
            });

            source.onmessage = function (event) {
                if (!event || !event.data) {
                    return;
                }

                try {
                    handlePayload(JSON.parse(event.data));
                } catch (error) {
                    console.error("Payload live invalide", error);
                }
            };

            source.onerror = function () {
                var now = Date.now();

                if (now - lastErrorAt > 30000) {
                    consecutiveErrors = 0;
                }

                lastErrorAt = now;
                consecutiveErrors += 1;

                // Si le flux est instable (ex: 500 repetes), on coupe SSE et on degrade en polling.
                if (consecutiveErrors >= 3 && source) {
                    source.close();
                    source = null;
                    usingPollingFallback = true;
                    startPollingFallback();
                }
            };
        }

        function startPollingFallback() {
            if (!window.taskLiveVersionUrl) {
                return;
            }

            var intervalMs = 15000;

            function loadVersion() {
                if (document.visibilityState === "hidden") {
                    window.setTimeout(loadVersion, intervalMs);
                    return;
                }

                $.ajax({
                    url: window.taskLiveVersionUrl,
                    method: "GET",
                    dataType: "json",
                    timeout: 3000
                }).done(function (response) {
                    handlePayload(response);
                }).always(function () {
                    window.setTimeout(loadVersion, intervalMs);
                });
            }

            window.setTimeout(loadVersion, 3000);
        }

        function bootstrapLiveState() {
            if (!window.taskLiveVersionUrl) {
                return;
            }

            $.ajax({
                url: window.taskLiveVersionUrl,
                method: "GET",
                dataType: "json",
                timeout: 4000,
                cache: false
            }).done(function (response) {
                if (response && typeof response.version !== "undefined") {
                    currentVersion = Number(response.version) || 0;
                }

                if (response && typeof response.draft_version !== "undefined") {
                    window.__taskLiveDraftVersion = 0;
                    handleDraftPayload(response);
                }
            });
        }

        bootstrapLiveState();

        if (typeof window.EventSource !== "undefined" && window.taskLiveStreamUrl) {
            startEventSource();
            return;
        }

        startPollingFallback();
    }

    $(startLiveSync);
})(jQuery);
