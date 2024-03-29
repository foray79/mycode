import pika
import sys

connect = pika.BlockingConnection(pika.ConnectionParameters(host="localhost"))

channel = connect.channel()

channel.exchange_declare(exchange="topic_log",exchange_type="topic")

result = channel.queue_declare('',exclusive=True)

queue_name = result.method.queue

binding_key = sys.argv[1:]

if not binding_key :
    sys.stderr.write("Usage: %s [binding_key]...\n" % sys.argv[0])
    sys.exit(1)

for key in binding_key :
    channel.queue_bind(exchange="topic_log",queue=queue_name,routing_key=key)

print(' [*] Waiting for logs. To exit press CTRL+C')

def callback(ch,method,properties,body):
    print(" [x] %r:%r" % (method.routing_key, body))

channel.basic_consume(queue=queue_name,on_message_callback=callback,auto_ack=True)

channel.start_consuming()