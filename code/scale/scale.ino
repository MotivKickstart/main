// Use this code after using scale_calibration code once

#include <EEPROM.h>
#include "HX711.h"
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <WiFi.h>
#include <PubSubClient.h>

#define EEPROM_SIZE 1
#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64

const int LOADCELL_DOUT_PIN = 4;
const int LOADCELL_SCK_PIN = 18;

// MQTT and WI-FI
#define SUBTOPIC "scaleTopic"
const char* ssid = "tesla iot";
const char* password = "fsL6HgjN";
const char* mqtt_server = "145.24.222.129";
const int mqtt_port = 1883;
WiFiClient espClient;
PubSubClient client(espClient);

HX711 scale;
Adafruit_SSD1306 oled(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);
String text;

void print_center(const char *text, int hight){
  int16_t x, y;
  uint16_t w, h;
  oled.getTextBounds(text, 0, 0, &x, &y, &w, &h);
  oled.setCursor((SCREEN_WIDTH - w) / 2, hight);
  oled.println(text);
}

void setup() {
  Serial.begin(9600);
  scale.begin(LOADCELL_DOUT_PIN, LOADCELL_SCK_PIN);
  EEPROM.begin(EEPROM_SIZE);

  scale.set_scale(-24);
  scale.tare();
  Serial.println("EEPROM ");
  Serial.println(EEPROM.read(0));

  if (!oled.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
    Serial.println(F("SSD1306 allocation failed"));
    while (true);
  }
  
  // WI-FI connect
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(250);
    Serial.print(".");
  }
  Serial.println("\nWiFi verbonden");
  
  // MQTT connect 
  client.setServer(mqtt_server, mqtt_port);
  while (!client.connected()) {
    Serial.print("Verbinding maken met MQTT-broker...");
    if (client.connect("ESP32Client")) {
      Serial.println("verbonden");
    } else {
      Serial.print("mislukt, rc=");
      Serial.print(client.state());
      Serial.println(" opnieuw proberen in 5 seconden");
      delay(5000);
    }
  }
}

void loop() {
  Serial.println(scale.get_units(1));
  oled.clearDisplay();
  oled.setTextSize(3);
  oled.setTextColor(WHITE);
  oled.setCursor(0, 10);
  int weight = scale.get_units(1) / 1000;
  text = String(weight);
  print_center(text.c_str(), 20);
  oled.display();

  // Send MQTT
  if (client.connected()) {
    client.publish(SUBTOPIC, text.c_str());
  }

  delay(1000);
}
