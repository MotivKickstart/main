#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>

#define SCREEN_WIDTH 128 // OLED display width,  in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels

// ROTARY ENCODER
#include <ezButton.h>  // the library to use for SW pin

#define CLK_PIN 25 // ESP32 pin GPIO25 connected to the rotary encoder's CLK pin
#define DT_PIN  26 // ESP32 pin GPIO26 connected to the rotary encoder's DT pin
#define SW_PIN  27 // ESP32 pin GPIO27 connected to the rotary encoder's SW pin

#define DIRECTION_CW  0   // clockwise direction
#define DIRECTION_CCW 1  // counter-clockwise direction

int counter = 0;
int direction = DIRECTION_CW;
int CLK_state;
int prev_CLK_state;
int menu_number = 0;
int selected = 0;
int amount_of_options = 7;

int amount_of_water = 0;
int amount_of_creatine = 0;
int amount_of_protein = 0;
int amount_of_preworkout = 0;
int amount_of_flavour = 0;

String text;

ezButton button(SW_PIN);  // create ezButton object that attach to pin 7;
Adafruit_SSD1306 oled(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);

void print_center(const char *text, int hight){
  int16_t x, y;
  uint16_t w, h;
  oled.getTextBounds(text, 0, 0, &x, &y, &w, &h);
  oled.setCursor((SCREEN_WIDTH - w) / 2, hight);        // position to display
  oled.println(text); // text to display
}

void setup() {
  Serial.begin(9600);

  // initialize OLED display with address 0x3C for 128x64
  if (!oled.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
    Serial.println(F("SSD1306 allocation failed"));
    while (true);
  }

  delay(2000);         // wait for initializing
  oled.clearDisplay(); // clear display

  oled.setTextSize(2);          // text size
  oled.setTextColor(WHITE);     // text color
  print_center("% MOTIV %", 20);
  oled.setTextSize(0.5);          // text size
  print_center("Booting...", 45);
  oled.display();               // show on OLED
  delay(2000);

  // configure encoder pins as inputs
  pinMode(CLK_PIN, INPUT);
  pinMode(DT_PIN, INPUT);
  button.setDebounceTime(50);  // set debounce time to 50 milliseconds

  // read the initial state of the rotary encoder's CLK pin
  prev_CLK_state = digitalRead(CLK_PIN);
}

int display_page(const char* name, const char* unit, int step_size, int max){
  int display_counter = counter * step_size;
  if (display_counter > max){
    display_counter = max;
    counter--;
  }
  oled.clearDisplay(); // clear display
  oled.setTextSize(1.1);          // text size
  oled.setTextColor(SSD1306_WHITE);
  text = "Amount of " + String(name);
  print_center(text.c_str(), 10);

  print_center("/\x5C", 30);
  text = String(display_counter) + " " + String(unit);
  print_center(text.c_str(), 40);
  print_center("\x5C/", 50);

  oled.display();               // show on OLED
  return display_counter;
}

void display_menu(){
  button.loop();  // MUST call the loop() function first

  // read the current state of the rotary encoder's CLK pin
  CLK_state = digitalRead(CLK_PIN);

  // If the state of CLK is changed, then pulse occurred
  // React to only the rising edge (from LOW to HIGH) to avoid double count
  if (CLK_state != prev_CLK_state && CLK_state == HIGH) {
    Serial.print("Rotary Encoder:: direction: ");
    // if the DT state is HIGH
    // the encoder is rotating in counter-clockwise direction => decrease the counter
    if (digitalRead(DT_PIN) == HIGH) {
      if (counter > 0){
        counter--;
      } 
      Serial.print("Counter-clockwise");
      if (menu_number == 0){
        if (selected > 0){
          selected--;
        } else {
          selected = amount_of_options - 1;
        }
      }
    } else {
      // the encoder is rotating in clockwise direction => increase the counter
      counter++;
      Serial.print("Clockwise");
      if (menu_number == 0){
        if (selected < amount_of_options - 1){
          selected++;
        } else {
          selected = 0;
        }
      }
    }
    Serial.print(" - count: ");
    Serial.print(counter);
    Serial.print(menu_number);
    Serial.println(selected);
    delay(250);
  }

  // save last CLK state
  prev_CLK_state = CLK_state;

  if (button.isPressed()) {
    Serial.println("The button is pressed");
    counter = 0;
    if (menu_number == 0){
      menu_number = selected + 1;
    } else {
      menu_number = 0;
    }
  }
  
  const char *options[7] = {
    " 1. Calibrate ",
    " 2. Pour Water ",
    " 3. Creatine ",
    " 4. Protein ",
    " 5. Preworkout ",
    " 6. Flav'n tasty ",
    " 7. Run ",
  };

  if (menu_number == 0){
    
    oled.clearDisplay(); // clear display
    oled.setTextSize(1.1);          // text size
    oled.setTextColor(SSD1306_WHITE);
    print_center("Choose option", 5);
    print_center("/\x5C", 15);
    int iterator = 0;
    if (selected <= 0){
      iterator = 0;
    } else if (selected >= amount_of_options - 2) {
      iterator = amount_of_options - 3;
    } else {
      iterator = selected - 1;
    }

    int vertical_iterator = 1;
    for (int i = iterator; i < iterator + 3; i++){
      if (i == selected) {
        oled.setTextColor(SSD1306_BLACK, SSD1306_WHITE);
        print_center(options[i], 17 + (vertical_iterator * 9));
        // oled.println(options[i]);
      } else if (i != selected) {
        oled.setTextColor(SSD1306_WHITE);
        print_center(options[i], 17 + (vertical_iterator * 9));
      }
      vertical_iterator++;
    }
    oled.setTextColor(SSD1306_WHITE);
    print_center("\x5C/", 55);
    

    oled.display();               // show on OLED
  } else if (menu_number == 1) {
    oled.clearDisplay(); // clear display
    oled.setTextSize(1.1);          // text size
    oled.setTextColor(SSD1306_WHITE);
    oled.setCursor(0, 10);        // position to display
    oled.println("Calibrating..."); // text to display
    oled.display();               // show on OLED
  } else if (menu_number == 2) {
    amount_of_water = display_page("Water", "ml", 50, 350);
  } else if (menu_number == 3) {
    amount_of_creatine = display_page("Creatine", "gram", 1, 5);
  }else if (menu_number == 4) {
    amount_of_protein = display_page("Protein", "gram", 5, 50);
  } else if (menu_number == 5){
    amount_of_preworkout = display_page("Preworkout", "gram", 1, 10);
  } else if (menu_number == 6){
    amount_of_flavour = display_page("Flav'n tasty", "gram", 1, 5);
  } else if (menu_number == 7) {
    oled.clearDisplay(); // clear display
    oled.setTextSize(1);          // text size
    oled.setTextColor(SSD1306_WHITE);
    oled.setCursor(0, 10);        // position to display
    oled.println("Are you sure you want"); // text to display
    oled.print("Water: "); // text to display
    oled.print(amount_of_water); // text to display
    oled.println(" ml"); // text to display
    oled.print("Creatine: "); // text to display
    oled.print(amount_of_creatine); // text to display
    oled.println(" gram"); // text to display
    oled.print("Protein: "); // text to display
    oled.print(amount_of_protein); // text to display
    oled.println(" gram"); // text to display
    oled.print("Preworkout: "); // text to display
    oled.print(amount_of_preworkout); // text to display
    oled.println(" gram"); // text to display
    oled.print("Flav'n tasty: "); // text to display
    oled.print(amount_of_flavour); // text to display
    oled.println(" gram"); // text to display
    oled.display(); 
  }

}


void loop() {
  display_menu();
}


