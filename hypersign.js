let ws = new WebSocket("wss://ssi.hypermine.in/developerws/");
    ws.onmessage = function({data }) {
        let messageData = JSON.parse(data);
        $("#qrcode").html("");
        if (messageData.op == 'init') {
            $("#qrcode").qrcode({ "width": 300, "height": 300, "text": JSON.stringify(messageData.data) });
        } else if (messageData.op == 'end') {
            ws.close();
            $("#qrcode").hide();
            const authorizationToken = messageData.data.token
            alert(authorizationToken)
        }
    };
