#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include "HX711.h"
#include "soc/rtc.h"

#define SCREEN_WIDTH 128 // OLED display width,  in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels

// ROTARY ENCODER
#include <ezButton.h>  // the library to use for SW pin

#define CLK_PIN 25 // ESP32 pin GPIO25 connected to the rotary encoder's CLK pin
#define DT_PIN  26 // ESP32 pin GPIO26 connected to the rotary encoder's DT pin
#define SW_PIN  27 // ESP32 pin GPIO27 connected to the rotary encoder's SW pin

#define DIRECTION_CW  0   // clockwise direction
#define DIRECTION_CCW 1  // counter-clockwise direction

const int LOADCELL_DOUT_PIN = 16;
const int LOADCELL_SCK_PIN = 4;

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
int known_weight = 6100;

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



void setup() {
  Serial.begin(9600);

  // initialize OLED display with address 0x3C for 128x64
  if (!oled.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
    Serial.println(F("SSD1306 allocation failed"));
    while (true);
  }
  // rtc_clk_cpu_freq_set(RTC_CPU_FREQ_80M);
  scale.begin(LOADCELL_DOUT_PIN, LOADCELL_SCK_PIN);

  delay(2000);
  oled.clearDisplay();
  oled.setTextSize(2);
  oled.setTextColor(WHITE);
  print_center("% MOTIV %", 20);
  oled.setTextSize(0.5);
  print_center("Booting...", 45);
  oled.display();
  delay(2000);
  // configure encoder pins as inputs
  pinMode(CLK_PIN, INPUT);
  pinMode(DT_PIN, INPUT);
  button.setDebounceTime(10);
  // read the initial state of the rotary encoder's CLK pin
  prev_CLK_state = digitalRead(CLK_PIN);
}

void loop() {
  if (scale.is_ready()){
    if (calibration_mode){
      calibrate();
    } else if (running_mode){
      run();
      // Serial.println(scale.get_units(10), 5);
    } else {
      display_menu();
    }
  } else {
    // Serial.println("HX711 not found..");
  }

}