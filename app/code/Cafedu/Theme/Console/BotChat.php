<?php

namespace Cafedu\Theme\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BotChat extends Command
{
    protected function configure()
    {
        $this->setName('skype:report');
        $this->setDescription('Demo command line');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = [
            'project' => 'v498-autotest',
            'message' => 'Hiếu Anh đẹp trai',
            'status' => 1,
            'link' => ''
        ];
        $data_string = json_encode($data);
        $curl = curl_init('https://cicd.bssdev.cloud/post');
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
    }
}
