#include <SPI.h>
#include <Ethernet.h>

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192,168,0,117);
EthernetClient client;

int analogInPin1 = A0;
int analogInPin2 = A1; 
int LED = 9;
int LED = 10;
int gate_in = 0;
int gate_out = 0;

char server[] = "192.168.0.105"; 

void setup() {
  Serial.begin(9600); 
  pinMode(LED, OUTPUT);
  Ethernet.begin(mac, ip);
}

void loop() {
 
  float gate_in = analogRead(analogInPin1);
  float gate_out = analogRead(analogInPin2);
 
  // Connect to the server (your computer or web page)  
  if (client.connect(server, 80)) {
    Serial.println("connected");

    if(gate_in <= 50){

      //for browser
      client.print("GET /project/data.php?");
      client.print("gate_in="); 
      client.print(gate_in); 
      client.println(" HTTP/1.1"); // Part of the GET request
      client.println("Host: 192.168.0.105"); 
      client.println("Connection: close"); 
      client.println(); // Empty line
      client.println(); // Empty line

      //Printing the values on the serial monitor
      Serial.print("gate_in= ");
      Serial.println('1');
      digitalWrite(LED,HIGH);

    }else {
      //for browser
      client.print("GET /project/data.php?");
      client.print("gate_in="); 
      client.print(gate_in); 
      client.println(" HTTP/1.1"); // Part of the GET request
      client.println("Host: 192.168.0.105"); 
      client.println("Connection: close"); 
      client.println(); // Empty line
      client.println(); // Empty line

      //Printing the values on the serial monitor
      Serial.print("gate_in= ");
      Serial.println('0');
      digitalWrite(LED,LOW);
    }
    
    if(gate_out <= 50){

      //for browser
      client.print("GET /project/data.php?");
      client.print("gate_out="); 
      client.print(gate_out); 
      client.println(" HTTP/1.1"); // Part of the GET request
      client.println("Host: 192.168.0.105"); 
      client.println("Connection: close"); 
      client.println(); // Empty line
      client.println(); // Empty line

      //Printing the values on the serial monitor
      Serial.print("gate_out= ");
      Serial.println('1');
      digitalWrite(LED,HIGH);

    }else {
      //for browser
      client.print("GET /project/data.php?");
      client.print("gate_out="); 
      client.print(gate_out); 
      client.println(" HTTP/1.1"); // Part of the GET request
      client.println("Host: 192.168.0.105"); 
      client.println("Connection: close"); 
      client.println(); // Empty line
      client.println(); // Empty line

      //Printing the values on the serial monitor
      Serial.print("gate_out= ");
      Serial.println('0');
      digitalWrite(LED,LOW);
    }
    client.stop();
  }

  else {
    // If Arduino can't connect to the server (your computer or web page)
    Serial.println("--> connection failed\n");
  }
 
  delay(5000);
}