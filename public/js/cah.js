let statusQueryData = {};
let statusQueryCallback = function (data) {};
let statusQueryBlocked = false;

let requireLogin = false;

$(function () {
    $("#logout-button").click(function () {
        $.post({
            url: baseurl + "/GameAPI/logout",
        }).done(function () {
            window.location = baseurl + "/login";
        });
    });

    statusQuery = function () {
        if (!statusQueryBlocked) {
            statusQueryBlocked = true;
            $.post({
                url: baseurl + "/GameAPI/status",
                data: statusQueryData,
            }).done(function (data) {
                if (typeof data.loggedIn == "undefined") {
                    data = JSON.parse(data);
                }

                if (requireLogin && !data.loggedIn) {
                    window.location = baseurl + "/login"
                }

                if (statusQueryCallback != null) {
                    statusQueryCallback(data);
                }

            }).always(function () {
                statusQueryBlocked = false;
            });
        }
    };

    statusQuery();
    setInterval(statusQuery, 1000);
});

