(function () {
    "use strict";

    function escapeHtml(value) {
        return String(value || "")
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/\"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function buildInitials(firstname, lastname) {
        var first = String(firstname || "").trim().charAt(0).toUpperCase();
        var last = String(lastname || "").trim().charAt(0).toUpperCase();
        var initials = first + last;

        return initials || "?";
    }

    function renderUsers($container, users) {
        var $list = $container.find(".js-connected-users-list").first();
        if ($list.length === 0) {
            return;
        }

        if (!Array.isArray(users) || users.length === 0) {
            $list.html("");
            $container.addClass("d-none");
            return;
        }

        var html = users.map(function (user) {
            var firstname = escapeHtml(user && user.firstname ? user.firstname : "");
            var lastname = escapeHtml(user && user.lastname ? user.lastname : "");
            var fullname = (firstname + " " + lastname).trim() || "Utilisateur";
            var avatarUrl = user && user.profile_picture_url ? String(user.profile_picture_url) : "";
            var initials = buildInitials(firstname, lastname);

            if (avatarUrl) {
                return '' +
                    '<span class="d-inline-flex align-items-center justify-content-center" ' +
                    'style="width:32px;height:32px;border-radius:50%;overflow:hidden;border:2px solid #21344a;background:#1a2f45;color:#fff;font-size:12px;font-weight:700;margin-left:6px;" ' +
                    'title="' + fullname + '">' +
                        '<img src="' + escapeHtml(avatarUrl) + '" alt="' + fullname + '" ' +
                        'style="width:100%;height:100%;object-fit:cover;display:block;">' +
                    '</span>';
            }

            return '' +
                '<span class="d-inline-flex align-items-center justify-content-center" ' +
                'style="width:32px;height:32px;border-radius:50%;overflow:hidden;border:2px solid #21344a;background:#1a2f45;color:#fff;font-size:12px;font-weight:700;margin-left:6px;" ' +
                'title="' + fullname + '">' + initials + '</span>';
        }).join("");

        $list.html(html);
        $container.removeClass("d-none");
    }

    function startConnectedUsersPolling() {
        if (typeof window.jQuery === "undefined") {
            return;
        }

        var $ = window.jQuery;
        var $container = $("#connected-users-topbar");
        if ($container.length === 0) {
            return;
        }

        var endpoint = String($container.data("endpoint") || "");
        if (!endpoint) {
            return;
        }

        var refresh = function () {
            $.ajax({
                url: endpoint,
                method: "GET",
                dataType: "json",
                cache: false,
                timeout: 5000
            }).done(function (response) {
                var users = response && Array.isArray(response.users) ? response.users : [];
                renderUsers($container, users);
            });
        };

        refresh();
        window.setInterval(refresh, 5000);

        document.addEventListener("visibilitychange", function () {
            if (!document.hidden) {
                refresh();
            }
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", startConnectedUsersPolling);
    } else {
        startConnectedUsersPolling();
    }
})();
