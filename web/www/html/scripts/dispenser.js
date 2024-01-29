const autoDispenseCheckbox = document.querySelector('#autoDispense');
const alarmsElement = document.querySelector('.alarms');

autoDispenseCheckbox.addEventListener('change', function() {
    if (autoDispenseCheckbox.checked) {
        alarmsElement.style.display = 'block';
    } else {
        alarmsElement.style.display = 'none';
    }
});

function publishDispense(){
    console.log("pubdjfjg");
    //e
}

function startConnect() {
    clientID = "webUser-" + parseInt(Math.random() * 100);
    host = "localhost";
    port = 1884;
    userId = "jelle";
    passwordId = "password";
    // document.getElementById("messages").innerHTML += "<span> Connecting to " + host + "on port " + port + "</span><br>";
    // document.getElementById("messages").innerHTML += "<span> Using the client Id " + clientID + " </span><br>";
    client = new Paho.MQTT.Client(host, Number(port), clientID);
    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;
    client.connect({
        //useSSL:true,
        userName: userId,
        password: passwordId,
        onSuccess: onConnect
    });
}

function onConnect() {
    topic = "test";
    console.log("Subscribing to topic " + topic);
    // document.getElementById("messages").innerHTML += "<span> Subscribing to topic " + topic + "</span><br>";
    client.subscribe(topic);
}

function onConnectionLost(responseObject) {
    // document.getElementById("messages").innerHTML += "<span> ERROR: Connection is lost.</span><br>";
    if (responseObject != 0) {
        console.log("error: " + responseObject.errorMessage);
    }
}

function onMessageArrived(message) {
    payload = message.payloadString;
    console.log("OnMessageArrived: " + payload + " Topic: " + topic);
}

function startDisconnect() {
    client.disconnect();
    console.log("disconnected");
    // document.getElementById("messages").innerHTML += "<span> Disconnected. </span><br>";
}
function publishMessage() {
    msg = document.getElementById("Message").value;
    topic = document.getElementById("topic_p").value;
    Message = new Paho.MQTT.Message(msg);
    Message.destinationName = topic;
    client.send(Message);
    document.getElementById("messages").innerHTML += '<p style="border: 1px solid black; border-right:none; margin: 0px; display:inline; padding-bottom: 20px;"> Message to topic ' + topic + ' is sent </p><br>';
}

startConnect();
console.log("hi");