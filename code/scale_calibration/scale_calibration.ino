// How to calibrate and save in flash memory
// 
// 1. Change "known_weight" variable with weight of object that is used to calibrate scale
// 2. Upload code to ESP32
// 3. Run code once and follow steps in Serial Monitor
// 4. Calibration complete and calibration factor saved to flash memory
// 5. Use other code for weighing other objects

#include <EEPROM.h>
#include "HX711.h"

#define EEPROM_SIZE 1

const int known_weight = 84000;
const int LOADCELL_DOUT_PIN = 4;
const int LOADCELL_SCK_PIN = 18;
int calibration_factor = 0;         // the current state of the output pin

HX711 scale;

void setup() { 
  Serial.begin(9600);
  scale.begin(LOADCELL_DOUT_PIN, LOADCELL_SCK_PIN);
  EEPROM.begin(EEPROM_SIZE);

  Serial.print("Flash test calibration factor: ");
  Serial.println(EEPROM.read(0));

  // Set scale
  scale.set_scale();

  // Reset scale to zero
  Serial.println("Tare... remove any weights from the scale.");
  delay(5000);
  scale.tare();

  // Get known weight
  Serial.println("Tare done...");
  Serial.println("Place a known weight on the scale...");
  delay(5000);

  // Print result
  long reading = scale.get_units(10);
  calibration_factor = reading/known_weight;
  Serial.print("Calibration factor: ");
  Serial.println(calibration_factor);
  scale.set_scale(calibration_factor);
  EEPROM.write(0, calibration_factor);
  EEPROM.commit();

  // Reset scale to zero
  Serial.println("Tare... remove any weights from the scale.");
  delay(5000);
  scale.tare();



  Serial.print("Flash test calibration factor: ");
  Serial.println(EEPROM.read(0));
}

void loop() {

}