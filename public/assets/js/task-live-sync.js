(function ($) {
    "use strict";

    function hasTaskTableOnPage() {
        return $("#tableOrderTaskP1, #tableOrderTaskP2").length > 0;
    }

    function shouldRunSync() {
        return Boolean(window.taskLiveVersionUrl) && hasTaskTableOnPage();
    }

    function startLiveSync() {
        if (!shouldRunSync()) {
            return;
        }

        var currentVersion = null;
        var lastLocalMutationAt = 0;
        var intervalMs = 2000;

        function markLocalMutation() {
            lastLocalMutationAt = Date.now();
        }

        window.addEventListener("task-live-local-change", markLocalMutation);

        function loadVersion() {
            $.ajax({
                url: window.taskLiveVersionUrl,
                method: "GET",
                dataType: "json",
                cache: false,
                timeout: 5000
            }).done(function (response) {
                if (!response || typeof response.version === "undefined") {
                    return;
                }

                var nextVersion = Number(response.version) || 0;

                if (currentVersion === null) {
                    currentVersion = nextVersion;
                    return;
                }

                if (nextVersion <= currentVersion) {
                    return;
                }

                currentVersion = nextVersion;

                if (Date.now() - lastLocalMutationAt < 4000) {
                    return;
                }

                window.location.reload();
            });
        }

        loadVersion();
        setInterval(loadVersion, intervalMs);
    }

    $(startLiveSync);
})(jQuery);
