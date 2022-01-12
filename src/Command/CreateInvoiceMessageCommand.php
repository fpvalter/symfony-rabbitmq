<?php

namespace App\Command;

use App\Message\TestMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ClienteRepository;
use App\Entity\Cliente;
use App\DBAL\Types\EstadoType;
use App\Message\InvoiceMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;


class CreateInvoiceMessageCommand extends Command
{

    protected static $defaultName = 'message:invoice:create';

    private $logger;
    private $messageBus;

    public function __construct(MessageBusInterface $bus, LoggerInterface $logger)
    {
        parent::__construct();

        $this->messageBus = $bus;
        $this->logger = $logger;
    }

    protected function configure()
    {
        $this->setDescription('Create a invoice message at RabbitMQ');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        $io->title('Create a invoice message at RabbitMQ');
        $this->logger->info('Create a invoice message at RabbitMQ');

        try {

            $message = new InvoiceMessage(101, 1500.00, 'Look! I created a invoice message!');

            $envelope = new Envelope($message, [
                new AmqpStamp('message_invoice') //you need to specify the routing key
            ]);

            $this->messageBus->dispatch($envelope);

            $this->logger->info('Invoice message created');
            $io->success('Invoice message created');
            
        } catch (\Exception $ex) {
            $this->logger->error('Message error: ' . $ex->getMessage());
            $io->error('Message error: ' . $ex->getMessage());

            dd($ex);
        }

        return 0;

    }

}
