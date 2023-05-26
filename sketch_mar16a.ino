//LIBRARY mikrokontroller
#ifdef ESP32
//jika memakasi mikrokontroller ESP32
  #include <WiFi.h>
  #include <HTTPClient.h>
#else
//jika memakasi mikrokontroller ESP8266
  #include <ESP8266WiFi.h>
  #include <ESP8266HTTPClient.h>
  #include <WiFiClient.h>
#endif
//library menjalankan SPI bus RFID reader
#include <SPI.h>
//library RFID reader
#include <MFRC522.h>
//library LCD I2C 16x2
#include <LiquidCrystal_I2C.h>

//inialisasi ssid dan password wifi DEVICE
//const char* ssid = "device";
//const char* password = "1234567890";

const char* ssid = "TEKNOPINK";
const char* password = "2019tetapjokowi";

//const char* ssid = "Square's Galaxy A21s";
//const char* password = "ilvr9369";

//IP ADDRESS PC
const char* host = "192.168.1.6";

//Inialisasi pinout dari ESP8266 (LED + buzzer)
#define LED_PIN D8
//#define BUZZER_PIN D8
#define BTN_PIN D0
//Inialisasi pinout dari ESP8266 (MFRC522 reader)
#define SDA_PIN D4 //pin D4 ESP8266
#define RST_PIN D3 //pin D4 ESP8266

//Pendefinisian sensor
MFRC522 mfrc522(SDA_PIN, RST_PIN);
//Pendefinisian LCD I2C 16x2 (dengan alamat LCD 0x27)
LiquidCrystal_I2C lcd(0x27,16, 2);

void setup() {
  //Baut rate
  Serial.begin(9600);
  Serial.setDebugOutput(true); 
  //panggil variable ssid, password
  WiFi.hostname("NodeMCU");
  WiFi.begin(ssid, password);
//  WiFi.begin(ssid_TRION, password_TRION);

  //looping while untuk cek koneksi apakah tersambung atau tidak dengan kondisi delay (.)
  while(WiFi.status() != WL_CONNECTED){
    delay (500);
    Serial.println(".");
  }
  //Kondisi jika sudah tersambung dengan wifi
  Serial.println("Wifi Connected");
  Serial.println("IP Address : ");
  Serial.println(WiFi.localIP());

  //inialisasi LED dan buzzer sebagai pin output
  pinMode (LED_PIN, OUTPUT);
  //pinMode (BUZZER_PIN, OUTPUT);
  pinMode (BTN_PIN, INPUT);
    
  lcd.init(); // inialisasi LCD
  //Print a message to the LCD.
  lcd.backlight();

  //untuk menjalankan reader
  SPI.begin();
  mfrc522.PCD_Init();

  //kondisi jika berhasil connect dengan alat
  lcd.print("SCAN KARTU");
  Serial.println("SCAN KARTU");
  Serial.println();
}

void loop() {
  WiFiClient client;
  if(digitalRead(BTN_PIN)==1){
    digitalWrite(LED_PIN, HIGH);
    delay(100);
    while(digitalRead(BTN_PIN)==1);
    String Link;
    HTTPClient http;
    //GET DATA
    Link = "http://192.168.1.6/rfid/ubahmode.php";
    http.begin(client, Link);

    int httpCode = http.GET();
    String payload = http.getString();

    Serial.println(payload);
    http.end();
  }
  //LED mati
  digitalWrite(LED_PIN, LOW);
  
  // kondisi apakah kartu tersebut baru
  if(! mfrc522.PICC_IsNewCardPresent())
      return ;
  // kondisi kartu tersebut di baca
  if(! mfrc522.PICC_ReadCardSerial())
      return;
  //kondisi indikator apabila berhasil membaca kartu
   digitalWrite (LED_PIN, LOW);
   delay(100);
   digitalWrite (LED_PIN, HIGH);
   delay(100);
//   digitalWrite (BUZZER_PIN, LOW);
//   delay(100);
//   digitalWrite (BUZZER_PIN, HIGH);
//   delay(100);
   String IDTAG = "";
   String MAC = WiFi.macAddress();
   
   
   Serial.print(" UID tag :");
   lcd.setCursor(0,1);
   lcd.print("ID :");

   //kondisi apabila hendak menemukan ID tiap masing masing kartu
   for(byte i=0; i<mfrc522.uid.size; i++){
     //IDTAG += (String(mfrc522.uid.uidByte[i], HEX));
     Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
     Serial.print(mfrc522.uid.uidByte[i], HEX);
     lcd.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
     lcd.print(mfrc522.uid.uidByte[i], HEX);
     //IDTAG.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
     IDTAG.concat(String(mfrc522.uid.uidByte[i], HEX));
   }

   //melakukan penyambungan port apache di 80
//   WiFiClient client;
   const int httpPort = 80;
   Serial.print("MAC Address ESP8266 =   ");
   Serial.println(WiFi.macAddress());
   
   //apabila tidak dapat terhubung akan terdapat indikator failed
   if(!client.connect(host, httpPort)){
    Serial.println("Connection Failed");
    return;
   }

   //melakukan pengiriman data ID dengan menggunakan PHP
   String Link;
   HTTPClient http;
   
   Link = "http://192.168.1.6/rfid/control3backup.php?IDTAG=" + IDTAG + "&MAC=" + MAC;
   http.begin(client, Link);

   int httpCode = http.GET();
   String payload = http.getString();
   Serial.println(payload);
   http.end();

   delay(2000);
}
