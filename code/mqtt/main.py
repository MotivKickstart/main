import mqtt as m
import mysql.connector

def onConnect(client, userdata, flags, rc):
    print("Connected with result code "+str(rc))
    client.subscribe("test")
    
def onMessage(client, userdata, msg):
    topic = str(msg.topic)
    m_decode = str(msg.payload.decode("utf-8", "ignore"))
    
if __name__ == "__main__":
    
    # db=_mysql.connect(host="localhost",user="myuser",password="myuser",database="mydb")
    
    mydb = mysql.connector.connect(
    host="localhost",
    user="myuser",
    password="password",
    database="mydb"
    )
    
    mycursor = mydb.cursor()

    mycursor.execute("SELECT * FROM user")

    myresult = mycursor.fetchall()

    for x in myresult:
        print(x)
    
    client = m.Mqtt("serverClient", onConnect, onMessage)
    client.connectMQTT()
    
    while True:
        pass