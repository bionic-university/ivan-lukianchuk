<?php

require "vendor/autoload.php";

spl_autoload_register(
    function ($class) {
        if (file_exists('src/' . $class . '.php')) require 'src/' . $class . '.php';
        if (file_exists('src/Element/' . $class . '.php')) require 'src/Element/' . $class . '.php';
    }
);


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Application;


class GreetCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('demo:demo')
            ->setDescription('Demonstration work of Alchemist');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $alchemist = new Alchemist(new Metal(), new Acid());
        $text = ($alchemist->isDissolved() ? 'Desolved' : 'Not desolved') . PHP_EOL;
        $text .= ($alchemist->isReversible() ? 'The Proccess is Reversible' : 'The Proccess is not Reversible') . PHP_EOL;
        $output->writeln($text);
    }
}

$application = new Application();
$application->add(new GreetCommand);
$application->run();