(function () {
    "use strict";

    if (typeof window.jQuery === "undefined") {
        return;
    }

    var $ = window.jQuery;
    var storageKey = "admin-theme";

    function applyTheme(theme) {
        var normalized = theme === "light" ? "light" : "dark";
        var $body = $("body");
        var $toggle = $("#adminThemeToggle");

        $body.removeClass("admin-theme-light admin-theme-dark");
        $body.addClass(normalized === "light" ? "admin-theme-light" : "admin-theme-dark");

        if ($toggle.length > 0) {
            var $icon = $toggle.find("i").first();
            if (normalized === "light") {
                $icon.removeClass("fa-moon").addClass("fa-sun");
                $toggle.attr("aria-label", "Activer le theme sombre");
                $toggle.attr("title", "Passer en theme sombre");
            } else {
                $icon.removeClass("fa-sun").addClass("fa-moon");
                $toggle.attr("aria-label", "Activer le theme clair");
                $toggle.attr("title", "Passer en theme clair");
            }
        }
    }

    function initTheme() {
        var savedTheme = window.localStorage ? window.localStorage.getItem(storageKey) : null;
        applyTheme(savedTheme || "dark");
    }

    $(document).on("input", ".js-admin-filter-input", function () {
        var query = String($(this).val() || "").toLowerCase().trim();
        var $table = $(this).closest(".admin-toolbar").nextAll(".admin-content-card").find("table.js-admin-table").first();

        if ($table.length === 0) {
            return;
        }

        $table.find("tbody tr").each(function () {
            var text = String($(this).text() || "").toLowerCase();
            $(this).toggle(text.indexOf(query) !== -1);
        });
    });

    function setSidebarOpen(open) {
        $(".admin-layout").toggleClass("sidebar-open", open);
    }

    $(document).on("click", "#adminSidebarToggle", function () {
        setSidebarOpen(true);
    });

    $(document).on("click", "#adminSidebarClose, #adminSidebarOverlay", function () {
        setSidebarOpen(false);
    });

    $(document).on("click", ".admin-side-link", function () {
        if (window.matchMedia("(max-width: 991px)").matches) {
            setSidebarOpen(false);
        }
    });

    $(document).on("click", "#adminThemeToggle", function () {
        var isLight = $("body").hasClass("admin-theme-light");
        var nextTheme = isLight ? "dark" : "light";
        applyTheme(nextTheme);
        if (window.localStorage) {
            window.localStorage.setItem(storageKey, nextTheme);
        }
    });

    initTheme();
})();
