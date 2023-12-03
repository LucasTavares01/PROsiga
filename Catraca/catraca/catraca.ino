#include <LiquidCrystal.h>
#include <Servo.h>

#include <SPI.h> //INCLUSÃO DE BIBLIOTECA
#include <MFRC522.h> //INCLUSÃO DE BIBLIOTECA
 
#define SS_PIN 53 //PINO SDA       OK
#define RST_PIN 5 //PINO DE RESET  OK

const int  servoPin = 3; //OK
Servo motor;
 
MFRC522 rfid(SS_PIN, RST_PIN); //PASSAGEM DE PARÂMETROS REFERENTE AOS PINOS

bool cartaoDetectado;
bool excessao;
bool cancelado;
bool passagemCompleta;
bool tempoExcedido;
bool modo;
long int cartao;
String nomeAluno;
bool reset;
const int tLimite = 8000;
bool falhaCOM;


  const int LED_R = 49; //OK
  const int LED_G = 48; //OK

  const int buzzer = 2; //OK

  const int pinLiberar = 47;
  const int pinCancelar = 46;

  LiquidCrystal lcd(12, 11, 10, 9, 8, 7);  //OK

  const int pinSensorPassagem1 = 44;
  const int pinSensorPassagem2 = 42;
  const int pinSensorPassagem3 = 43;
  const int pinModo = 22;
  int ultPassagem;

void setup()
{
  pinMode(LED_R, OUTPUT);
  pinMode(LED_G, OUTPUT);

  pinMode(buzzer, OUTPUT);

  pinMode(pinLiberar, INPUT);
  pinMode(pinCancelar, INPUT);
  pinMode(pinSensorPassagem1, INPUT);
  pinMode(pinSensorPassagem2, INPUT);
  pinMode(pinSensorPassagem3, INPUT);

  
  pinMode(pinModo, INPUT);

  modo = digitalRead(pinModo)==1;

  lcd.begin(16, 2);
  reset = true;
  pinMode(6, OUTPUT);  //OK;
  analogWrite(6, 0); 

  Serial.begin(9600); //INICIALIZA A SERIAL
  SPI.begin(); //INICIALIZA O BARRAMENTO SPI
  rfid.PCD_Init(); //INICIALIZA MFRC522

  motor.attach(servoPin);
  servo(true);
  if(digitalRead(pinSensorPassagem1)==1)
  {
    ultPassagem = 1;
  }
  else if(digitalRead(pinSensorPassagem2)==1)
  {
    ultPassagem = 2;
  }
  else if(digitalRead(pinSensorPassagem3)==1)
  {
    ultPassagem = 3;
  }
}

void loop()
{
  
  limparDados();

  mensagemInicial();
  
  detectarCartao();
  detectarExcessao(); 

  if(cartaoDetectado)
  {    
    if(alunoEncontrado())
    {      
      liberarPassagem();
      if(passagemCompleta) registrarPassagem();
      else mensagemErro();     
    }
    else
    {
      alunoNaoEncontrado();      
    }
  }
  else if (excessao)
  {
    liberarPassagem();
    if(passagemCompleta) registrarPassagem();
    else mensagemErro(); 
  }

  

}


void mensagemInicial()
{
  if(reset)
  {
    printCenter("Aguardando..", "Passe o Cartao");
    reset=false;
  }
  
}

//leitura do RFID
bool detectarCartao()
{

  if (!rfid.PICC_IsNewCardPresent() || !rfid.PICC_ReadCardSerial()) //VERIFICA SE O CARTÃO PRESENTE NO LEITOR É DIFERENTE DO ÚLTIMO CARTÃO LIDO. CASO NÃO SEJA, FAZ
    return; //RETORNA PARA LER NOVAMENTE
 
  /***INICIO BLOCO DE CÓDIGO RESPONSÁVEL POR GERAR A TAG RFID LIDA***/
  String strID = "";
  for (byte i = 0; i < 4; i++) {
    strID +=
    (rfid.uid.uidByte[i] < 0x10 ? "0" : "") +
    String(rfid.uid.uidByte[i], HEX) +
    (i!=3 ? ":" : "");
  }
  strID.toUpperCase();
  /***FIM DO BLOCO DE CÓDIGO RESPONSÁVEL POR GERAR A TAG RFID LIDA***/    
  rfid.PICC_HaltA(); //PARADA DA LEITURA DO CARTÃO
  rfid.PCD_StopCrypto1(); //PARADA DA CRIPTOGRAFIA NO PCD

  cartao = hexStringToInt(strID);
  cartaoDetectado = cartao!=-1;
  if (cartaoDetectado)
  {
    reset = true;
    printCenter("Detectado", "" +cartao);
    sinal(true, true, 200, 1);
    delay(200);
  } 
  else
  {
    printCenter("Erro", "Cartão Invalido");
    sinal(false, true, 100, 2);
    delay(2000);
  }

}

int hexStringToInt(String hexString) {
  int result = 0;
  int base = 16; // Base hexadecimal

  // Remove os dois pontos da string
  hexString.replace(":", "");

  for (int i = 0; i < hexString.length(); i++) {
    char c = hexString.charAt(i);
    int digit = hexCharToInt(c);

    if (digit == -1) {
      // Caractere inválido na string hexadecimal
      return -1;
    }

    result = result * base + digit;
  }

  return result;
}

int hexCharToInt(char c) {
  if (c >= '0' && c <= '9') {
    return c - '0';
  } else if (c >= 'A' && c <= 'F') {
    return 10 + c - 'A';
  } else if (c >= 'a' && c <= 'f') {
    return 10 + c - 'a';
  }
  return -1; // Caractere inválido
}


bool isInteger(String str)
{
  for (unsigned int i = 0; i < str.length(); i++)
  {
    if (!isdigit(str.charAt(i)))
    {
      return false;
    }
  }
  return true;
}

//botao liberar apertado
bool detectarExcessao()
{  
  excessao = digitalRead(pinLiberar)==1;
  if(excessao) reset = true;
}

bool alunoEncontrado() {
  printCenter("Procurando", "");
   nomeAluno = "";
   Serial.print("?");
   Serial.println(cartao);

  falhaCOM = false;
  long tInicial = millis();
  long tAtual;
    
  // Aguarda até que uma nova linha seja recebida na porta serial
  while (!Serial.available() && !falhaCOM) {
    tAtual = millis();
    falhaCOM = (tAtual-tInicial) > tLimite;
    delay(10);
  }

  String linha = Serial.readStringUntil('\n');

  if (linha.length() > 0) {
    // Obtém o primeiro caractere da linha
    char primeiroCaractere = linha.charAt(0);

    if (primeiroCaractere == '@') {
      // Se o primeiro caractere for '@', armazena o restante da linha em nomeAluno
      nomeAluno = linha.substring(1);
      cartaoDetectado=true;
      return true;
    } else if (primeiroCaractere == '!') {
      return false;
    }
  }

  // Retorna um valor padrão caso a linha não seja válida
  return false;
}


//comunicação com o BD
bool encontrarAluno()
{
  printCenter("Procurando", "");
   nomeAluno = "";
   Serial.print("?");
   Serial.println(cartao);
   char sinal;
   String serialCont = ""; // Variável para armazenar o conteúdo da porta serial

  // Aguarda até que uma linha completa seja recebida
  while (Serial.available() > 0) {
    char c = Serial.read();

    // Verifica se o caractere atual é um retorno de carro ('\r') ou uma quebra de linha ('\n')
    if (c == '\r' || c == '\n') {
      // Processa a linha recebida
      if (serialCont.length() > 0) {
        sinal = serialCont.charAt(0);

        nomeAluno = "";

        if (sinal == '@')
        {
          
          for(int i=1; i<serialCont.length(); i++) nomeAluno+=serialCont.charAt(i);

          return true;
        }
        else return false;

        // Limpa a variável para a próxima linha
        serialCont = "";
      }
    } else {
      // Adiciona o caractere à variável serialCont
      serialCont += c;
    }
  }
  
}

void alunoNaoEncontrado()
{
  if(falhaCOM) printCenter("Erro", "Sem Resposta");
  else printCenter("Erro", "Aluno Invalido");
  sinal(false, true, 100, 2);
  delay(2000);
}

//liberar trava
void liberarPassagem()
{
  servo(false);
  String msg;
  if(modo) msg = "Bem-Vindo(a)";
  else msg = "Ate Logo";
  printCenter(msg, nomeAluno);
  sinal(true, true, 200, 1);
  
  cancelado = false;
  passagemCompleta = false;
  tempoExcedido = false;
  long tInicial = millis();
  long tAtual;
  do
  {
    tAtual = millis();
    tempoExcedido = (tAtual-tInicial) > tLimite;
    cancelado = digitalRead(pinCancelar)==1;
    passagemCompleta = detectarPassagem();
  }while( !cancelado && !passagemCompleta && !tempoExcedido);
  servo(true);
}

bool detectarPassagem()
{

  if(ultPassagem!=1 && digitalRead(pinSensorPassagem1)==1)
  {
    ultPassagem = 1;
    return true;
  }
  else if(ultPassagem!=2 && digitalRead(pinSensorPassagem2)==1)
  {
    ultPassagem = 2;
    return true;
  }
  else if(ultPassagem!=3 && digitalRead(pinSensorPassagem3)==1)
  {
    ultPassagem = 3;
    return true;
  }
  return false;
}

void mensagemErro()
{
  String mensagem;
  if(cancelado) mensagem = "Cancelado";
  else mensagem = "Tempo Excedido";

  printCenter(mensagem, "");
  sinal(false, true, 100, 2);
  delay(2000);
  
}

//enviar confirmação para o BD
void registrarPassagem()
{
  sinal(true, true, 200, 1);
  char msg;
  if(modo) msg = '+';
  else msg = '-';

  if(!cartaoDetectado)cartao = 0;

  Serial.print(msg);
  Serial.println(cartao);
  
}

//limpar dados
void limparDados()
{
  cancelado = false;
  passagemCompleta = false;
  tempoExcedido = false;
  cartaoDetectado = false;
  falhaCOM =  false;
  cartao = 0;
  excessao = false;
  nomeAluno = "";
  modo = digitalRead(pinModo)==1;
}

void sinal(bool cor, bool som, int duracao, int vezes)
{
  int vRed;
  int vGreen;
  int volume;
  
  if (cor)
  {
    vGreen = 255;
    vRed = 0;
  }
  else
  {
    vGreen = 0;
    vRed = 255;
  }

  if(som) volume = 255;
  else volume = 0;

  for(int i=0; i<vezes; i++)
  {
    analogWrite(LED_R, vRed);
    analogWrite(LED_G, vGreen);
    analogWrite(buzzer, volume);
  
    delay(duracao);

    analogWrite(LED_R, 0);
    analogWrite(LED_G, 0);
    analogWrite(buzzer, 0);

    delay(duracao/2);  
  }
 }

 void printCenter(String line0, String line1)
{
  lcd.clear();
  int pos = (16-line0.length())/2;
  if(pos<0) pos = 0;
  lcd.setCursor(pos, 0);
  lcd.print(line0);
  pos = (16-line1.length())/2;
  if(pos<0) pos = 0;
  lcd.setCursor(pos, 1);
  lcd.print(line1);
}

void servo(bool status)
{
  if(status) motor.write(0);
  else motor.write(170);
}
