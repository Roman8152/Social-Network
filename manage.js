function getMessages() {
    var div = $("#getMsg");
    $.get("messages.php", function(data) {
        event.preventDefault();
        div.html(data);
    });
}

    setInterval(getMessages, 10000);
