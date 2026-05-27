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

    function actionLabel(action) {
        if (action === "created") {
            return "a ajoute une tache";
        }

        if (action === "deleted") {
            return "a supprime une tache";
        }

        return "a modifie une tache";
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
        var tableSelector = getActiveTableSelector();

        if (tableSelector === "#tableOrderTaskP1") {
            return "#inlineAddTaskP1Row";
        }

        if (tableSelector === "#tableOrderTaskP2") {
            return "#inlineAddTaskP2Row";
        }

        return null;
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
            deadline_display: formatDraftDeadline(getFormValue($form, "input[name$='[deadline]']")),
            note: getFormValue($form, "textarea[name$='[note]'], input[name$='[note]']"),
            visible: !$form.find("tr").first().hasClass("d-none")
        };
    }

    function ensureDraftIndicator() {
        var box = document.getElementById("task-live-draft-indicator");
        if (!box) {
            box = document.createElement("div");
            box.id = "task-live-draft-indicator";
            box.style.position = "fixed";
            box.style.left = "16px";
            box.style.bottom = "16px";
            box.style.zIndex = "9998";
            box.style.background = "#1a2230";
            box.style.color = "#ffffff";
            box.style.border = "1px solid rgba(243,196,65,.8)";
            box.style.borderRadius = "12px";
            box.style.padding = "12px 14px";
            box.style.display = "none";
            box.style.maxWidth = "420px";
            box.style.boxShadow = "0 10px 28px rgba(0,0,0,.30)";
            document.body.appendChild(box);
        }

        return box;
    }

    function clearDraftIndicator(scope) {
        var box = document.getElementById("task-live-draft-indicator");
        if (!box) {
            return;
        }

        if (scope && box.dataset.scope && box.dataset.scope !== scope) {
            return;
        }

        box.style.display = "none";
        box.innerHTML = "";
        box.dataset.scope = "";
    }

    function showDraftIndicator(payload) {
        var draftState = (payload && payload.draft) || {};
        var draft = draftState.draft || draftState;
        var actor = draftState.actor || {};
        var actorName = [actor.firstname || "Quelqu'un", actor.lastname || ""].join(" ").trim();
        var customer = draft.customer || "";
        var subject = draft.subject || "";
        var users = Array.isArray(draft.users) ? draft.users.join(", ") : "";
        var deadline = draft.deadline_display || "";
        var note = draft.note || "";

        var lines = [];
        if (customer) {
            lines.push("Client: " + customer);
        }
        if (subject) {
            lines.push("Sujet: " + subject);
        }
        if (users) {
            lines.push("Equipe: " + users);
        }
        if (deadline) {
            lines.push("Deadline: " + deadline);
        }
        if (note) {
            lines.push("Note: " + note);
        }

        var box = ensureDraftIndicator();
        var avatarHtml = actor.profile_picture_url
            ? '<img src="' + actor.profile_picture_url + '" alt="avatar" style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid #f3c441;">'
            : '<span style="display:inline-flex;width:40px;height:40px;border-radius:50%;align-items:center;justify-content:center;background:#31465f;color:#fff;font-weight:700;">' + buildInitials(actor) + "</span>";

        box.dataset.scope = payload.scope || "";
        box.style.display = "flex";
        box.style.alignItems = "flex-start";
        box.style.columnGap = "10px";
        box.style.transition = "opacity .25s ease, transform .25s ease";
        box.style.opacity = "1";
        box.style.transform = "translateY(0)";

        box.innerHTML = '' +
            avatarHtml +
            '<div style="line-height:1.25">' +
                '<div style="font-weight:700;">' + escapeHtml(actorName) + ' prepare une tache</div>' +
                '<div style="font-size:13px;color:#d5dfeb;margin-top:4px;">' + (lines.length ? lines.map(function (line) { return escapeHtml(line); }).join('<br>') : 'Ajout en cours...') + '</div>' +
            '</div>';
    }

    function escapeHtml(value) {
        return $("<div>").text(value ?? "").html();
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
                clearDraftIndicator(activeScope);
                return;
            }

            if (activeDraft.tab_id && String(activeDraft.tab_id) === String(window.__taskLiveTabId)) {
                return;
            }

            showDraftIndicator({
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
            clearDraftIndicator(activeScope);
            return;
        }

        if (draft.tab_id && String(draft.tab_id) === String(window.__taskLiveTabId)) {
            return;
        }

        showDraftIndicator({
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

        clearDraftIndicator(activeScope);
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

    function clearDraftState($form, config) {
        if (!window.taskLiveDraftUrl || !$form || !$form.length) {
            return;
        }

        $.ajax({
            url: window.taskLiveDraftUrl,
            method: "DELETE",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({
                scope: config.rowSelector,
                tab_id: window.__taskLiveTabId
            }),
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        });

        clearDraftIndicator(config.rowSelector);
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

        $form.on("input change", "input, textarea, select", function () {
            scheduleDraftSync();
            startHeartbeat();
        });

        $form.on("focusin", "input, textarea, select", function () {
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
                stopHeartbeat();
                clearDraftState($form, config);
            }
        });

        window.addEventListener("task-live-local-change", function () {
            if (!isFormVisible() && hasLocalDraft) {
                hasLocalDraft = false;
                stopHeartbeat();
                clearDraftState($form, config);
            }
        });

        $form.on("submit", function () {
            if (isFormVisible()) {
                scheduleDraftSync();
            }
        });
    }

    function showLiveNotification(change) {
        var actor = (change && change.actor) || {};
        var actorName = [actor.firstname || "Quelqu'un", actor.lastname || ""].join(" ").trim();
        var action = actionLabel(change && change.action);
        var subject = change && change.task_subject ? String(change.task_subject) : "";

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

        box.innerHTML = '' +
            avatarHtml +
            '<div style="line-height:1.25">' +
                '<div style="font-weight:700;">' + safeActorName + '</div>' +
                '<div style="font-size:13px;color:#d5dfeb;">' + action + (safeSubject ? (': ' + safeSubject) : '') + '</div>' +
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
        }, 4500);
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
