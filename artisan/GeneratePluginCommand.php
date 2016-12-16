<?php

/**
 * Created by PhpStorm.
 * User: placeless
 * Date: 16/12/16
 * Time: 上午11:22
 */
namespace Artisan;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Yaf\Exception;

class GeneratePluginCommand extends Command
{
    //Argument 需要自己在configure()中设置
    private $type = 'Plugin';
    private $templatePath = TEMPLATE_PATH . '/plugin.php';
    private $outputDir = APPLICATION_PATH . '/application/plugins/';
    private $outputFileName;
    private $classNameSuffix = 'Plugin';
    private $fileNameSuffix = '';
    private $name = 'create:plugin';
    private $description = 'Creates new plugin.';
    private $help = "This command allows you to create plugins...";
    private $usage = 'Sample';

    protected function configure()
    {
        //记得修改argument
        $this->setName($this->name)
            ->setDescription($this->description)
            ->setHelp($this->help)
            ->addArgument('plugin', InputArgument::REQUIRED, 'The name of the model.')
            ->addUsage($this->usage);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arg = $input->getArgument('plugin');
        $this->outputFileName = $this->outputDir . ucfirst($arg) . $this->fileNameSuffix . '.php';
        $template = require_once $this->templatePath;
        $data = sprintf($template, ucfirst($arg).$this->classNameSuffix,ucfirst($arg).$this->classNameSuffix);

        $output->writeln([
            ucfirst($arg) . ' ' . $this->type . ' Creating',
            '============',
        ]);

        if (file_exists($this->outputDir)) {
            if (!is_writable($this->outputDir)) {
                throw new Exception('File can\'t writable');
            }

            if (file_exists($this->outputFileName)) {
                $helper = $this->getHelper('question');
                $question = new ConfirmationQuestion('File exists,Continue with this action,overwrite it?(y|n)?', false);

                if (!$helper->ask($input, $output, $question)) {
                    return;
                } else {
                    file_put_contents($this->outputFileName, $data);
                    $output->writeln('Congratulation!');
                    $output->writeln('Overwrite a ' . ucfirst($arg) . ' ' . $this->type . ' successfully');
                    return;
                }
            }
            file_put_contents($this->outputFileName, $data);
            $output->writeln('Congratulation!');
            $output->writeln('Create a ' . ucfirst($arg) . ' ' . $this->type . ' successfully');
        } else {
            throw new Exception('Dirctory not exists!' . $this->outputDir);
        }
    }
}