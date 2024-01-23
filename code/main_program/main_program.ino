#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <EEPROM.h>
#include "HX711.h"
#include "soc/rtc.h"

#define SCREEN_WIDTH 128 // OLED display width,  in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels
#define EEPROM_SIZE 1

// ROTARY ENCODER
#include <ezButton.h>  // the library to use for SW pin

#define CLK_PIN 25 // ESP32 pin GPIO25 connected to the rotary encoder's CLK pin
#define DT_PIN  26 // ESP32 pin GPIO26 connected to the rotary encoder's DT pin
#define SW_PIN  27 // ESP32 pin GPIO27 connected to the rotary encoder's SW pin

#define DIRECTION_CW  0   // clockwise direction
#define DIRECTION_CCW 1  // counter-clockwise direction

const int LOADCELL_DOUT_PIN = 16;
const int LOADCELL_SCK_PIN = 4;

// const int water_pump = 13;

int counter = 0;
int direction = DIRECTION_CW;
int CLK_state;
int prev_CLK_state;
int menu_number = 0;
int selected = 0;
int amount_of_options = 5;

// Calibration variables
bool calibration_mode = false;
int calibrate_option = 0;
int calibration_counter = 0;
float calibration_factor = 0;
long reading = 0;
int known_weight = 63; //Weight of motiv bottle
// int known_weight = 100;

// Running variables
bool running_mode = false;
int running_counter = 0;
int running_option = 0;

int amount_of_water = 0;
int amount_of_creatine = 0;
int amount_of_protein = 0;
int amount_of_preworkout = 0;
int amount_of_flavour = 0;

String text;
HX711 scale;

ezButton button(SW_PIN);  // create ezButton object that attach to pin 7;
Adafruit_SSD1306 oled(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);

void startup_screen(){
  oled.clearDisplay();
  oled.setTextSize(2);
  oled.setTextColor(WHITE);
  print_center("% MOTIV %", 20);
  oled.setTextSize(0.5);
  print_center("Booting...", 45);
  oled.display();
  delay(2000);
}

void setup() {
  Serial.begin(9600);
  // Configure oled
  if (!oled.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
    Serial.println(F("SSD1306 allocation failed"));
    while (true);
  }
  startup_screen();
  // Configure EEPROM
  EEPROM.begin(EEPROM_SIZE);
  // Configure scale
  scale.begin(LOADCELL_DOUT_PIN, LOADCELL_SCK_PIN);
  calibration_factor = EEPROM.readFloat(0);
  Serial.print("calibration_factor ======== ");
  Serial.println(calibration_factor);
  scale.set_scale(calibration_factor);
  scale.tare();
  // Configure rotary encoder
  pinMode(CLK_PIN, INPUT);
  pinMode(DT_PIN, INPUT);
  pinMode(12, OUTPUT);
  button.setDebounceTime(10);
  prev_CLK_state = digitalRead(CLK_PIN);
}

void loop() {
  if (scale.is_ready()){
    if (calibration_mode){
      calibrate();
    } else if (running_mode){
      run();
    } else {
      display_menu();
    }
    // Serial.println(scale.get_units(1));
  } else {}
}
