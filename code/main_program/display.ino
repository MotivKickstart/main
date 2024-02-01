void check_for_input(){
  CLK_state = digitalRead(CLK_PIN);

  if (CLK_state != prev_CLK_state && CLK_state == HIGH) {
    Serial.print("Rotary Encoder:: direction: ");
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
}

void print_center(const char *text, int hight){
  int16_t x, y;
  uint16_t w, h;
  oled.getTextBounds(text, 0, 0, &x, &y, &w, &h);
  oled.setCursor((SCREEN_WIDTH - w) / 2, hight);
  oled.println(text);
}

int display_page(const char* name, const char* unit, int step_size, int max){
  int display_counter = counter * step_size;
  if (display_counter > max){
    display_counter = max;
    counter--;
  }
  oled.clearDisplay();
  oled.setTextSize(1.1);
  oled.setTextColor(SSD1306_WHITE);
  text = "Amount of " + String(name);
  print_center(text.c_str(), 10);
  print_center("/\x5C", 30);
  text = String(display_counter) + " " + String(unit);
  print_center(text.c_str(), 40);
  print_center("\x5C/", 50);
  oled.display();
  return display_counter;
}

void display_menu(){
  button.loop();
  check_for_input();
  
  const char *options[amount_of_options] = {
    " 1. Water ",
    " 2. Creatine ",
    " 3. Protein ",
    " 4. Run ",
    " 5. Calibrate ",
  };

  if (menu_number == 0){
    oled.clearDisplay();
    oled.setTextSize(1.1);
    oled.setTextColor(SSD1306_WHITE);
    print_center("Choose option", 5);
    print_center("/\x5C", 16);

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
      } else if (i != selected) {
        oled.setTextColor(SSD1306_WHITE);
        print_center(options[i], 17 + (vertical_iterator * 9));
      }
      vertical_iterator++;
    }
    oled.setTextColor(SSD1306_WHITE);
    print_center("\x5C/", 54);
    
    oled.display();
  } else if (menu_number == 1) {
    amount_of_water = display_page("Water", "ml", 50, 350);
  } else if (menu_number == 2) {
    amount_of_creatine = display_page("Creatine", "gram", 1, 5);
  }else if (menu_number == 3) {
    amount_of_protein = display_page("Protein", "gram", 5, 50);
  } else if (menu_number == 4) {
    running_mode = true;
  } else if (menu_number == 5) {
    calibration_mode = true;
  } 
}
