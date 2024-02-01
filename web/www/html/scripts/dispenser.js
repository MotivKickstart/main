const autoDispenseCheckbox = document.querySelector('#autoDispense');
const alarmsElement = document.querySelector('.alarms');

autoDispenseCheckbox.addEventListener('change', function () {
    if (autoDispenseCheckbox.checked) {
        alarmsElement.style.display = 'block';
    } else {
        alarmsElement.style.display = 'none';
    }
});

function publishDispense() {
    publishMessage('{"user": "testUser", "product": "Skopa", "protein": 5, "creatine": 20, "water": 200}');
}

function startConnect() {
    clientID = "webUser-" + parseInt(Math.random() * 100);
    host = "145.24.222.129"; // this sends the messages to the server. not to localhost
    port = 1884;
    userId = "jelle";
    passwordId = "password";
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
    topic = "skopaTopic";
    console.log("Subscribing to topic " + topic);
    client.subscribe(topic);
}

function onConnectionLost(responseObject) {
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
}
function publishMessage(message) {
    topic = "skopaTopic";
    Message = new Paho.MQTT.Message(message);
    Message.destinationName = topic;
    client.send(Message);
    console.log("sending message: " + message);
}

startConnect();
console.log("hi");