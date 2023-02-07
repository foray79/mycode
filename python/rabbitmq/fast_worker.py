import pika, sys, os
import time

def main():
    
    connection = pika.BlockingConnection(pika.ConnectionParameters(host='localhost'))
    channel = connection.channel()
   
    channel.queue_declare(queue='hello')    

    def callback(ch, method, properties, body):
        now = time.localtime()
        print( " [x] 수신 %r" % body.decode())
        time.sleep(1)
        print( "["+time.strftime('%H%M%S', now)+"] 완료 :  ")
        ch.basic_ack(delivery_tag = method.delivery_tag)
       #print(" [x] Received %r" % body)

    channel.basic_qos(prefetch_count=1)
    channel.basic_consume(queue='hello', on_message_callback=callback)#, auto_ack=True)
    
    print(' [*] Waiting for messages. To exit press CTRL+C')
    channel.start_consuming()

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print('Interrupted')
        try:
            sys.exit(0)
        except SystemExit:
            os._exit(0)