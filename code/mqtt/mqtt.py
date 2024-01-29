import paho.mqtt.client as m

# Mqtt credentials
user = "jelle"
password = "password"
broker = "localhost"
port = 1883
# clientName = "server"
# client = None

class Mqtt:
    def __init__(self, clientName, onConnect, onMessage) -> None:
        self.client = m.Client(clientName)
        self.client.on_connect = onConnect
        self.client.on_message = onMessage

    # Initialize MQTT
    def connectMQTT(self): 
        try:
            print("Connecting to MQTT...")
            self.client.username_pw_set(user, password)
            self.client.connect(broker, port)
            self.client.loop_start()
            print("Connected to MQTT")
        except:
            print("Error connnecting to the MQTT broker")

    def publish(self, topic, payload):
        self.client.publish(topic, payload)