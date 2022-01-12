# symfony-rabbitmq

To send a message you may to use CreateInvoiceMessageCommand. Remenber that you need to setup a queue named queue_invoice

To ready this message, you may to use this command: php bin/console messenger:consume async

You can signup for free at cloudmq.com to create a RabbitMQ instance