<?php
namespace ASPTest\Views\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use ASPTest\Controllers\User;

class UserCreateCommand extends Command
{    
    protected function configure() {
        $this
            ->setName('USER:CREATE')
            ->setDescription("Create a new User")
            ->addArgument('userFirstName', InputArgument::REQUIRED, 'Please enter your first name: ', null)
            ->addArgument('userLastName', InputArgument::REQUIRED, 'Please enter your last name: ', null)
            ->addArgument('userEmail', InputArgument::REQUIRED, 'Please enter your e-mail address: ', null)
            ->addArgument('userAge', InputArgument::OPTIONAL, 'You can enter your age if you want: ', null);
    }

    // =====================================================
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userFirstName = $input->getArgument('userFirstName');
        $userLastName = $input->getArgument('userLastName');
        $userEmail = $input->getArgument('userEmail');
        $userAge = $input->getArgument('userAge');

        $data = array();

        $data = [
            "userFirtName" => $userFirstName,
            "userLastName" => $userLastName,
            "userEmail" => $userEmail,
            "userAge" => $userAge
        ];

        $user = new User();
        if($user->createUser($data) == true) {
            $dataOut = json_encode($data);
            $output->writeln("\n\r====SUCCESS!====\n\r"); 
            $output->writeln("User data: " .$dataOut);         
        }

        return 0;
        
    }

    // =====================================================
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $userFirstName = $input->getArgument('userFirstName');
        $userLastName = $input->getArgument('userLastName');
        $userEmail = $input->getArgument('userEmail');
        $userAge = $input->getArgument('userAge');

        $data = array();

        $data = [
            "userFirstName" => $userFirstName,
            "userLastName" => $userLastName,
            "userEmail" => $userEmail,
            "userAge" => $userAge
        ];

        $user = new User();  
        $results = $user->validateCreateUser($data);  

        if(array_key_exists('status', $results)) {
          $status = $results['status'];
        } 
    
        if($status == false) {
            $message = $results['message'];
            $output->writeln($message); 

            die();
        }        
    }

    // =====================================================
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        echo "Initializing...\n\r";
        echo "Welcome!\n\r";
        echo "Syntax: USER:CREATE: [First name][Last name][E-mail][<Age>]\n\r";
    }

}
