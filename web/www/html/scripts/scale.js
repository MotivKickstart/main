// const autoDispenseCheckbox = document.querySelector('#autoDispense');
// const alarmsElement = document.querySelector('.alarms');

// autoDispenseCheckbox.addEventListener('change', function() {
//     if (autoDispenseCheckbox.checked) {
//         alarmsElement.style.display = 'block';
//     } else {
//         alarmsElement.style.display = 'none';
//     }
// });

function publishDispense(){
    console.log("pubdjfjg");
    publishMessage('{"user": "testUser", "product": "Skopa", "protein": 5, "creatine": 20, "water": 200}');
    //e
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
    document.getElementById("weight").innerHTML = " " + payload + " Kg"
    // document.getElementById("messages").innerHTML += "<span> Disconnected. </span><br>";
}

function startDisconnect() {
    client.disconnect();
    console.log("disconnected");
    // document.getElementById("messages").innerHTML += "<span> Disconnected. </span><br>";
}
function publishMessage(message) {
    // msg = document.getElementById("Message").value;
    topic = "skopaTopic";
    Message = new Paho.MQTT.Message(message);
    Message.destinationName = topic;
    client.send(Message);
    console.log("sending message: " + message);
    // document.getElementById("messages").innerHTML += '<p style="border: 1px solid black; border-right:none; margin: 0px; display:inline; padding-bottom: 20px;"> Message to topic ' + topic + ' is sent </p><br>';
}

startConnect();
console.log("hi");