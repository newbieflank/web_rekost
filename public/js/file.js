window.addEventListener('beforeunload',
    function (e) {
        $.ajax({
            url: "http://localhost/web_rekost/out",
            method: "GET"
        });

        (e || window.event).returnValue = confirmationMessage;
        return confirmationMessage;
    });
