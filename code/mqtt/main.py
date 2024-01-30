import mqtt as m
import pyodbc

def onConnect(client, userdata, flags, rc):
    print("Connected with result code "+str(rc))
    client.subscribe("test")
    
def onMessage(client, userdata, msg):
    topic = str(msg.topic)
    m_decode = str(msg.payload.decode("utf-8", "ignore"))
    
if __name__ == "__main__":
    
    # db=_mysql.connect(host="localhost",user="myuser",password="myuser",database="mydb")
    
    # driver_names = [x for x in pyodbc.drivers() if x.endswith(' for SQL Server')]
    
    # for x in driver_names:
    #     print(x)
    
    SERVER = 'mysql'
    DATABASE = 'mydb'
    USERNAME = 'myuser'
    PASSWORD = 'password'
    
    connectionString = f'DRIVER={{ODBC Driver 17 for SQL Server}};SERVER={SERVER};DATABASE={DATABASE};UID={USERNAME};PWD={PASSWORD}'
    
    conn = pyodbc.connect(connectionString)
    
    # conn = pyodbc.connect('DRIVER={ODBC Driver 17 for SQL Server};Server=localhost;Database=mydb;Port=3306;User ID=myuser;Password=password')
    
    cursor = conn.cursor()
    
    client = m.Mqtt("serverClient", onConnect, onMessage)
    client.connectMQTT()
    
    while True:
        pass