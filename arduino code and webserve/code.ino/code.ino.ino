#include <SPI.h>
#include <Ethernet.h>

int analogInPin1 = A0;
int analogInPin2 = A1; 
int LED1 = 9;
int LED2 = 10;

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
byte ip[] = {192, 168, 0, 117 }; //Enter the IP of ethernet shield
byte serv[] = {192, 168, 0, 112} ; //Enter the IPv4 address
EthernetClient client;


void setup() {
  Serial.begin(9600); //setting the baud rate at 9600
  pinMode(LED1, OUTPUT);
  pinMode(LED2, OUTPUT);
  Ethernet.begin(mac, ip);
}

void loop() {
  float gatein = analogRead(analogInPin1);
  float gateout = analogRead(analogInPin2);
 
  if (client.connect(serv, 80)) { //Connecting at the IP address and port we saved before

    Serial.println("connected");
    client.print("GET /project/data.php?"); //Connecting and Sending values to database

    if ( gatein >= 50 ) {

      int gate_in = 1;
      int gate_out = 0;

      client.print("gate_in=");
      client.print(gate_in);
      client.print("&gate_out=");
      client.print(gate_out);

      Serial.print("gate_in= ");
      Serial.println(gate_in);
      digitalWrite(LED1,HIGH);

      Serial.print("gate_out= ");
      Serial.println(gate_out);
      digitalWrite(LED2,HIGH);

      client.println(" HTTP/1.1"); 
      client.println("Host: 192.168.0.112"); 
      client.println("Connection: close"); 
      client.println();
      client.println();

    } else if( gateout >= 50 ) {

      int gate_in = 0;
      int gate_out = 1;

      client.print("gate_in=");
      client.print(gate_in);
      client.print("&gate_out=");
      client.print(gate_out);

      Serial.print("gate_in= ");
      Serial.println(gate_in);
      digitalWrite(LED1,HIGH);

      Serial.print("gate_out= ");
      Serial.println(gate_out);
      digitalWrite(LED2,HIGH);

      client.println(" HTTP/1.1"); 
      client.println("Host: 192.168.0.112"); 
      client.println("Connection: close"); 
      client.println();
      client.println();

    } else {
    
      int gate_in = 0;
      int gate_out = 0;

      client.print("gate_in=");
      client.print(gate_in);
      client.print("&gate_out=");
      client.print(gate_out);
      
      Serial.print("gate_in= ");
      Serial.println(gate_in);
      digitalWrite(LED1, LOW);

      Serial.print("gate_out= ");
      Serial.println(gate_out);
      digitalWrite(LED2, LOW);

      client.println(" HTTP/1.1"); 
      client.println("Host: 192.168.0.112"); 
      client.println("Connection: close"); 
      client.println();
      client.println();
    }
    
  } else {

    Serial.println("connection failed");
  }

  delay(5000);
}