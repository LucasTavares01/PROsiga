import serial
import mysql.connector

# Configuração da porta serial
porta_serial = serial.Serial('COM3', 9600)  # Substitua 'COMx' pela porta serial correta
porta_serial.timeout = 1

# Configuração do banco de dados MySQL
conexao_bd = mysql.connector.connect(
    host="localhost",
    user="CATRACA",
    password="123456",
    database="ESCOLA"
)
cursor = conexao_bd.cursor()

# Função para realizar a pesquisa no banco de dados
def pesquisar_aluno(id_aluno):
    try:
        cursor.execute("SELECT NOME FROM ALUNO WHERE RA = %s", (id_aluno,))
        resultado = cursor.fetchone()
        if resultado:
            return resultado[0]  # Retorna o nome encontrado
        else:
            return None  # Retorna None se o aluno não for encontrado
    except mysql.connector.Error as erro:
        return f"Erro no banco de dados: {erro}"

# Função para atualizar o status do aluno no banco de dados
def atualizar_status(id_aluno, novo_status):
    try:
        cursor.execute("UPDATE ALUNO SET STATUS = %s WHERE RA = %s", (novo_status, id_aluno))
        conexao_bd.commit()
    except mysql.connector.Error as erro:
        return f"Erro no banco de dados: {erro}"
    
# Função para registrar passagem
def registrar_log(msg, id_aluno):

    if msg :
        acao = "ENTRADA"
    else:
        acao = "SAIDA"

    try:
        cursor.execute("INSERT INTO LOG_ENTR_SAID (RA, ACAO) VALUES (%s, %s)", (id_aluno, acao))
        conexao_bd.commit()
    except mysql.connector.Error as erro:
        print(erro)
        return f"Erro no banco de dados: {erro}"

# Loop principal
while True:
    # Aguarda a mensagem do Arduino
    mensagem_recebida = porta_serial.readline().decode().strip()
    if mensagem_recebida != "":
        print(f'Dados recebidos: {mensagem_recebida}')
        # Verifica o primeiro caractere da mensagem
        if mensagem_recebida.startswith('?'):
            # Pesquisa o nome do aluno
            id_aluno = int(mensagem_recebida[1:])
            print(f'id_aluno: {id_aluno}')
            nome_encontrado = pesquisar_aluno(id_aluno)

            # Envia a resposta para o Arduino
            if nome_encontrado:
                resposta = f'@{nome_encontrado}'
            else:
                resposta = '!Aluno não encontrado'

            print(f'Dados enviados: {resposta}')

            porta_serial.write(resposta.encode())
        elif mensagem_recebida.startswith('+'):
            # Registra a entrada do aluno
            id_aluno = int(mensagem_recebida[1:])
            registrar_log(True, id_aluno)
            if id_aluno != 0:
                atualizar_status(id_aluno, "PRESENTE")
        elif mensagem_recebida.startswith('-'):
            # Registra a saída do aluno
            id_aluno = int(mensagem_recebida[1:])
            registrar_log(False, id_aluno)
            if id_aluno != 0:
                atualizar_status(id_aluno, "AUSENTE")

    

# Fechar a conexão com o banco de dados
cursor.close()
conexao_bd.close()