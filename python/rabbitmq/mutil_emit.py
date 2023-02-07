import pika

connection = pika.BlockingConnection(pika.ConnectionParameters('localhost'))
channel = connection.channel()

channel.queue_declare(queue='hello')


for v in range(20) :    
    msg = "hello world : "+str(v)
    channel.basic_publish(exchange='',routing_key='hello',body=msg,
    properties=pika.BasicProperties(
                         delivery_mode=pika.spec.PERSISTENT_DELIVERY_MODE # make message persistent
                      ))
    print("sent :"+msg)
                      
connection.close()