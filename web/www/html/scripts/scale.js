
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
    topic = "scaleTopic";
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
    document.getElementById("weight").innerHTML = " " + payload + " Kg"
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

function saveWeight() {
    const weightElement = document.querySelector('#weight');
    const weight = weightElement.innerHTML;

    const historyElement = document.querySelector('.history');
    const listItem = document.createElement('li');
    listItem.textContent = weight;
    historyElement.appendChild(listItem);
}