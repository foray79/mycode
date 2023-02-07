import pika
import sys

connect = pika.BlockingConnection(pika.ConnectionParameters(host="localhost"))

channel = connect.channel()

channel.exchange_declare(exchange="topic_log",exchange_type="topic")

routing_key = sys.argv[1] if len(sys.argv)>2 else 'anonymous.info'

message = ' '.join(sys.argv[2:]) or 'Hello World!'

channel.basic_publish(exchange='topic_log',routing_key=routing_key,body=message)
print(" [x] Sent %r:%r" % (routing_key, message))
connect.close()
