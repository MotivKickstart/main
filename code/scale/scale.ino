// Use this code after using scale_calibration code once

#include <EEPROM.h>
#include "HX711.h"
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>

#define EEPROM_SIZE 1
#define SCREEN_WIDTH 128 // OLED display width,  in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels

const int LOADCELL_DOUT_PIN = 16;
const int LOADCELL_SCK_PIN = 4;

HX711 scale;
Adafruit_SSD1306 oled(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);

void setup() {
  Serial.begin(9600);
  scale.begin(LOADCELL_DOUT_PIN, LOADCELL_SCK_PIN);
  EEPROM.begin(EEPROM_SIZE);

  // Setup scale with calibration factor from flash memory
  scale.set_scale(EEPROM.read(0));
  scale.tare();
  Serial.println("EEPROM ");
  Serial.println(EEPROM.read(0));
}

void loop() {
  // Display scale value every second
  oled.clearDisplay();
  oled.setTextSize(2);
  oled.setTextColor(WHITE);
  oled.setCursor(0, 10);
  oled.println(scale.get_units(), 1);
  oled.display();
  delay(1000);


  // Print readings from scale
  // Serial.print("one reading:\t");
  // Serial.print(scale.get_units(), 1);
  // Serial.print("\t| average:\t");
  // Serial.println(scale.get_units(10), 5);

}
