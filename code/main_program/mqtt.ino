// Code for wifi and mqtt part

// MQTT and WI-FI connfig
void mqtt_setup(){
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(250);
    Serial.print(".");
  }
  Serial.println("\nWiFi verbonden");
  client.setServer(mqtt_server, mqtt_port);
  client.setCallback(callback);
  while (!client.connected()) {
    Serial.print("Verbinding maken met MQTT-broker...");
    if (client.connect("ESP32Client")) {
      Serial.println("verbonden");
      client.subscribe(SUBTOPIC); // Subscribe to the topic with qos 1
    } else {
      Serial.print("mislukt, rc=");
      Serial.print(client.state());
      Serial.println(" opnieuw proberen in 5 seconden");
      delay(5000);
    }
  }
}

void callback(char* topic, byte* payload, unsigned int length) {
  DynamicJsonDocument doc(1024);
  DeserializationError error = deserializeJson(doc, payload, length);

  if (error) {
    Serial.println(error.c_str());
    return;
  }

  const char* user = doc["user"];
  const char* product = doc["product"];
  int protein = doc["protein"];
  int creatine = doc["creatine"];
  int water = doc["water"];

  amount_of_protein = protein;
  amount_of_creatine = creatine;
  amount_of_water = water;
  oled.clearDisplay();
  oled.setTextSize(1);
  oled.setTextColor(SSD1306_WHITE);
  print_center("Dispence from", 20);
  print_center("motiv app", 30);
  oled.display();
  delay(2500);
  running_mode = true;
  running_option = 1;
}

void reconnect() {
  while (!client.connected()) {
    Serial.print("Opnieuw verbinden met MQTT-broker...");
    if (client.connect("ESP32Client")) {
      Serial.println("verbonden");
      client.subscribe(SUBTOPIC);
    } else {
      Serial.print("mislukt, rc=");
      Serial.print(client.state());
      Serial.println(" opnieuw proberen in 5 seconden");
      delay(5000);
    }
  }
}
