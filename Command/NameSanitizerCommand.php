<?php

namespace MauticPlugin\AMNameSanitizerBundle\Command;

use Mautic\CoreBundle\Command\ModeratedCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NameSanitizerCommand extends ModeratedCommand
{
    protected function configure()
    {
        $this->setName('mautic:sanitize-names')
            ->setDescription('Faz uma validação e correção de todos os nomes na base do Mautic.')
            ->setHelp('Este comando vai checar todos os nomes de contatos cadastrados no Mautic e corrigi-los, deixando apenas as primeiras letras em maiúsculo e separando o primeiro nome dos outros.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $model = $this->getContainer()->get('mautic.namesanitizer.model.model'); //Acessa o model
        $names = $model->getNames();

        $altNames = 0;
        $output->writeln("<info>Limpando nomes...</info>");
        foreach ($names as $lead) {
            if ($model->updateName($lead)) {
                $altNames++;
            }
        }
        $output->writeln("<comment>Nomes limpos. $altNames contatos alterados no total.</comment>");

        return;
    }
}
