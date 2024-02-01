// Mode for calibration

long previous_time = 0;
long interval = 1000;
bool button_can_be_pressed = true;

void check_press_calibration(){
  unsigned long current_time = millis();
  if (button.isPressed() && button_can_be_pressed) {
    button_can_be_pressed = false;
    Serial.println("The button is pressed in calibration mode");
    if (calibration_counter == 0){
      calibrate_option++;
    } else {
      calibration_mode = false;
      menu_number = 0;
      calibrate_option = 0;
      calibration_counter = 0;
    }
  }
  if (current_time - previous_time > interval){
    previous_time = current_time;
    button_can_be_pressed = true;
  }
  Serial.print("calibrate_option: ");
  Serial.println(calibrate_option);
  
  CLK_state = digitalRead(CLK_PIN);
  if (CLK_state != prev_CLK_state && CLK_state == HIGH) {
    Serial.print("Rotary Encoder:: direction: ");
    if (digitalRead(DT_PIN) == HIGH) {
      Serial.print("Counter-clockwise");
      calibration_counter--;
    } else {
      Serial.print("Clockwise");
      calibration_counter++;
    }
    delay(250);
  }
}

void calibrate(){
  const char* text1;
  const char* text2;
  button.loop();
  check_press_calibration();
  prev_CLK_state = CLK_state;
  calibration_counter = abs(calibration_counter%2);

  if (calibrate_option == 0){
    text1 = "Do you want to";
    text2 = "calibrate load cell?";
  }

  if (calibrate_option == 1){
    text1 = "Put empty bottle";
    text2 = "on loadcell";
    scale.set_scale();
    calibrate_option++;
  }

  if (calibrate_option == 2){
    text1 = "Remove everything";
    text2 = "from loadcell";
  }

  if (calibrate_option == 3){
    text1 = "Put the motiv";
    text2 = "bottle on loadcell";
    scale.tare();
    reading = 0;
    calibrate_option++;
  }

  if (calibrate_option == 4){
    text1 = "Put the motiv";
    text2 = "bottle on loadcell";
  }

  if (calibrate_option == 5){
    text1 = "Remove everything";
    text2 = "from loadcell";
    if (reading == 0){
      reading = scale.get_units(10);
      calibration_factor = (reading)/(known_weight);
      EEPROM.writeFloat(0, calibration_factor);
      // EEPROM.commit();
      scale.set_scale(calibration_factor);
      Serial.println(reading);
      Serial.println(calibration_factor);
    }
  }

  if (calibrate_option == 6){
    scale.tare();
    calibrate_option++;
  }

  if (calibrate_option == 7){
    oled.clearDisplay();
    oled.setTextSize(1);
    oled.setTextColor(SSD1306_WHITE);
    print_center("Calibration complete", 10);
    oled.setTextColor(SSD1306_BLACK, SSD1306_WHITE);
    print_center("Finish", 50);
    oled.setTextColor(SSD1306_WHITE);
    calibration_counter = 1;
    oled.display();
  }
  
  if (calibrate_option < 7){
    oled.clearDisplay();
    oled.setTextSize(1);
    oled.setTextColor(SSD1306_WHITE);
    print_center(text1, 10);
    print_center(text2, 20);
    if (calibration_counter == 0){
      oled.setTextColor(SSD1306_BLACK, SSD1306_WHITE);
    } else {
      oled.setTextColor(SSD1306_WHITE);
    }
    oled.setCursor(10, 50);
    oled.print("Continue");
    if (calibration_counter == 1){
      oled.setTextColor(SSD1306_BLACK, SSD1306_WHITE);
    } else {
      oled.setTextColor(SSD1306_WHITE);
    }
    oled.setCursor(90, 50);
    oled.print("Cancel");
    oled.display();
  }
}
