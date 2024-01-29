void mqtt_setup(){
  // MQTT and WI-FI connfig
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
  Serial.println("Nieuw MQTT-bericht ontvangen:");
  Serial.print("Onderwerp: ");
  Serial.println(topic);

  // Ontleed het JSON-bericht
  DynamicJsonDocument doc(1024); // Kies een geschikte grootte afhankelijk van je JSON-formaat
  DeserializationError error = deserializeJson(doc, payload, length);

  // Controleer op fouten tijdens het ontleden
  if (error) {
    Serial.print("Fout tijdens het ontleden van JSON: ");
    Serial.println(error.c_str());
    return;
  }

  // Haal de waarden uit het JSON-document
  const char* user = doc["user"];
  const char* product = doc["product"];
  int protein = doc["protein"];
  int creatine = doc["creatine"];
  int water = doc["water"];

  // Voer hier logica uit op basis van de ontleden JSON-gegevens
  Serial.println("Ontleden JSON-gegevens:");
  Serial.print("Gebruiker: ");
  Serial.println(user);
  Serial.print("Product: ");
  Serial.println(product);
  Serial.print("Proteïne: ");
  amount_of_protein = protein;
  Serial.println(protein);
  Serial.print("Creatine: ");
  amount_of_creatine = creatine;
  Serial.println(creatine);
  Serial.print("Water: ");
  amount_of_water = water;
  Serial.println(water);
  running_mode = true;
  running_option = 1;
}

void reconnect() {
  while (!client.connected()) {
    Serial.print("Opnieuw verbinden met MQTT-broker...");
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
