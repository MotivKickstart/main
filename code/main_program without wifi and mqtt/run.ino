// Code when running pumps
#define creatine_motor = 2;

long previous_run_time = 0;
long run_interval = 1000;
bool button_can_be_pressed_run = true;
bool emergency_stop = false;

void turn_off_relais(){
  digitalWrite(water_pump, HIGH);
  digitalWrite(creatine_pump, HIGH);
  digitalWrite(protein_pump, HIGH);
}

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
      running_option = 0;
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

void dispense(const char* name, int motor_number, int amount){
  oled.clearDisplay();
  oled.setTextSize(1);
  oled.setTextColor(SSD1306_WHITE);
  text = "Dispensing " + String(name);
  print_center(text.c_str(), 20);
  print_center("Press to cancel", 40);
  oled.display();
  delay(1000);
  unsigned long current_weight = scale.get_units(1);
  unsigned long goal_weight = current_weight + amount;
  Serial.println(current_weight);
  Serial.println(goal_weight);
  while(current_weight <= goal_weight && !emergency_stop){
    unsigned long current_time = millis();
    button.loop();
    Serial.print("Current weight ================= ");
    Serial.println(current_weight);
    
    if (button.isPressed() && button_can_be_pressed_run) {
      button_can_be_pressed_run = false;
      Serial.println("The button is pressed while pouring");
      emergency_stop = true;
      running_option = 4;
    }
    if (current_time - previous_run_time > run_interval){
      previous_run_time = current_time;
      button_can_be_pressed_run = true;
    }
    current_weight = scale.get_units(1);
  }
  emergency_stop = false;
  running_option++;
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
    if(amount_of_creatine > 0){
      digitalWrite(creatine_pump, LOW);
      dispense("Creatine", 2, amount_of_creatine);
    } else {
      running_option++;
    }
    turn_off_relais();
  } else if (running_option == 2){
    if(amount_of_protein > 0){
      digitalWrite(protein_pump, LOW);
      dispense("Protein", 3, amount_of_protein);
    } else {
      running_option++;
    }
    turn_off_relais();
  } else if (running_option == 3){
    if(amount_of_water > 0){
      digitalWrite(water_pump, LOW);
      dispense("Water", 4, amount_of_water);
    } else {
      running_option++;
    }
    turn_off_relais();
  } else if (running_option == 4){
    turn_off_relais();
    oled.clearDisplay();
    oled.setTextSize(1);
    oled.setTextColor(SSD1306_WHITE);
    print_center("Shake is done", 20);
    print_center("Enjoy!", 40);
    oled.display();
    delay(3000);
    running_option = 6;
  } else if (running_option == 5){
    turn_off_relais();
    oled.clearDisplay();
    oled.setTextSize(1);
    oled.setTextColor(SSD1306_WHITE);
    print_center("Emergency stop", 20);
    oled.display();
    delay(3000);
    running_option = 6;
  } else if (running_option == 6){
    running_mode = false;
    menu_number = 0;
    running_option = 0;
    running_counter = 0;
  }


  Serial.println(running_option); 
  // Serial.println(scale.get_units(1));
}
