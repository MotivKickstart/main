// Code when running pumps

long previous_run_time = 0;
long run_interval = 1000;
bool button_can_be_pressed_run = true;

// Code for rotary encoder when in run mode
void check_press_running(){
  unsigned long current_time = millis();
  button.loop();
  if (button.isPressed() && button_can_be_pressed_run) {
    button_can_be_pressed_run = false;
    Serial.println("The button is pressed in running mode");
    if (running_counter == 0){
      running_option++;
    } else {
      running_mode = false;
      menu_number = 0;
      running_counter = 0;
    }
  }
  if (current_time - previous_run_time > run_interval){
    previous_run_time = current_time;
    button_can_be_pressed_run = true;
  }
  CLK_state = digitalRead(CLK_PIN);
  if (CLK_state != prev_CLK_state && CLK_state == HIGH) {
    Serial.print("Rotary Encoder:: direction: ");
    if (digitalRead(DT_PIN) == HIGH) {
      Serial.println("Counter-clockwise");
      running_counter--;
    } else {
      Serial.println("Clockwise");
      running_counter++;
    }
    delay(250);
  }
  prev_CLK_state = CLK_state;
  running_counter = abs(running_counter%2);
}

void run(){
  check_press_running();
  unsigned long start_time = millis();
  unsigned long current_time;
  unsigned long previous_time;

  if (running_option == 0){
    oled.clearDisplay();
    oled.setTextSize(1);
    oled.setTextColor(SSD1306_WHITE);
    text = "Are you sure you want";
    print_center(text.c_str(), 10);
    text = "Water: " + String(amount_of_water) + " ml";
    print_center(text.c_str(), 20);
    text = "Creatine: " + String(amount_of_creatine) + " gram";
    print_center(text.c_str(), 30);
    text = "Protein: " + String(amount_of_protein) + " gram";
    print_center(text.c_str(), 40);
    if (running_counter == 0){
      oled.setTextColor(SSD1306_BLACK, SSD1306_WHITE);
    } else {
      oled.setTextColor(SSD1306_WHITE);
    }
    oled.setCursor(10, 50);
    oled.print("Yes");
    if (running_counter == 1){
      oled.setTextColor(SSD1306_BLACK, SSD1306_WHITE);
    } else {
      oled.setTextColor(SSD1306_WHITE);
    }
    oled.setCursor(100, 50);
    oled.print("No");
    oled.display();
  } else if (running_option == 1){
    oled.clearDisplay();
    oled.setTextSize(1);
    oled.setTextColor(SSD1306_WHITE);
    print_center("Dispensing creatine", 20);
    print_center("Press to cancel", 40);
    unsigned long starting_weight = scale.get_units(10);
    Serial.println("Dispensing creatine");
    unsigned long current_weight = scale.get_units(10);
    Serial.println(starting_weight);
    Serial.println(current_weight);
    while(starting_weight - current_weight < amount_of_creatine){
      check_press_running();
      running_counter = 0;
      Serial.println("Pouring creatine");
      current_weight = scale.get_units(10);
      // Zet motor van creatine aan
      if (!running_mode){
        break;
      }
    }
    oled.display();
    // Zet motor creatine uit
  }
  Serial.println(running_option);





}