<?php
namespace ASPTest\Views\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use ASPTest\Controllers\User;

class UserCreatePwdCommand extends Command
{    
    protected function configure() {
        $this
            ->setName('USER:CREATE-PWD')
            ->setDescription("Create a new password for a user in database.")
            ->addArgument('userId', InputArgument::REQUIRED, 'Please enter an existing UserId: ', null)
            ->addArgument('userPass', InputArgument::REQUIRED, 'Please enter the new password: ', null)
            ->addArgument('userConfirmPass', InputArgument::REQUIRED, 'Please confirm the new password: ', null);
    }

    // =====================================================
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userId = $input->getArgument('userId');
        $userPass = $input->getArgument('userPass');
        $userConfirmPass = $input->getArgument('userConfirmPass');       

        $data = array();

        $data = [
            "userId" => $userId,
            "userPass" => $userPass,
            "userConfirmPass" => $userConfirmPass            
        ];     

        $user = new User();
        if($user->createPwd($data) == true) {
            $output->writeln("\n\r====SUCCESS! New password added!====\n\r");            
        }  

        return 0;
    }

    // =====================================================
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $userId = $input->getArgument('userId');
        $userPass = $input->getArgument('userPass');
        $userConfirmPass = $input->getArgument('userConfirmPass');

        $data = [
            'userId' => $userId,
            'userPass' => $userPass,
            'userConfirmPass' => $userConfirmPass
        ];

        $user = new User();
        $results = $user->validateCreatePwd($data);

        if(array_key_exists('status', $results)) {
          $status = $results['status'];
        } else {
            $status = true;
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
        echo "Syntax: USER:CREATE-PWD: [userID][New password][Confirm the new password]\n\r";
    }

}
