(function ($) {
    "use strict";

    if (window.__taskLiveSyncStarted) {
        return;
    }

    window.__taskLiveSyncStarted = true;
    window.__taskLiveNotificationTimer = null;

    function hasTaskTableOnPage() {
        return $("#tableOrderTaskP1, #tableOrderTaskP2").length > 0;
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
        var lastLocalMutationAt = 0;
        var source = null;
        var usingPollingFallback = false;

        function markLocalMutation() {
            lastLocalMutationAt = Date.now();
        }

        window.addEventListener("task-live-local-change", markLocalMutation);

        function handlePayload(response) {
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

        if (typeof window.EventSource !== "undefined" && window.taskLiveStreamUrl) {
            startEventSource();
            return;
        }

        startPollingFallback();
    }

    $(startLiveSync);
})(jQuery);
