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

class GenerateControllerCommand extends Command
{
    //Argument 需要自己在configure()中设置
    private $type = 'Controller';
    private $templatePath = TEMPLATE_PATH . '/controller.php';
    private $defaultDir = APPLICATION_PATH . '/application/controllers/';
    private $moduleDir = APPLICATION_PATH . '/application/modules/';
    private $outputFileName;
    private $classNameSuffix = 'Controller';
    private $fileNameSuffix = '';
    private $name = 'create:controller';
    private $description = 'Creates new controller.';
    private $help = "This command allows you to create controllers...";
    private $usage = '{Module/Controller} like index@index';

    protected function configure()
    {
        //记得修改argument
        $this->setName($this->name)
            ->setDescription($this->description)
            ->setHelp($this->help)
            ->addArgument('controller', InputArgument::REQUIRED, 'require module name and controller name .')
            ->addUsage($this->usage);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arg = $input->getArgument('controller');
//    [dirname] => .
//    [basename] => asdas
//    [filename] => asdas
        $pathinfo = pathinfo($arg);
        if ($pathinfo['dirname'] === '.') {
            throw  new Exception('Controller 参数设置错误,无法解析！' . $arg);
        }
        if (pathinfo($pathinfo['dirname'])['dirname'] !== '.') {
            throw  new Exception('Controller 参数设置错误,无法解析！' . $arg);
        }
        $moduleName = $pathinfo['dirname'];
        $controllerName = $pathinfo['filename'];
        //创建目录结构
//        if ($moduleName !='index') {
//
//            if (!is_dir($this->moduleDir)) {
//                mkdir($this->moduleDir);
//            } else {
//                if (!is_dir($this->moduleDir.'/'.$moduleName)) {
//                    mkdir($this->moduleDir.'/'.$moduleName);
//                }
//            }
//        }
        //index模块与其他模块分开处理

        switch ($moduleName) {
            case 'index':
                $this->outputFileName = $this->defaultDir . ucfirst($contollerName) . $this->fileNameSuffix . '.php';
                $template = require_once $this->templatePath;
                $data = sprintf($template, ucfirst($contollerName) . $this->classNameSuffix,ucfirst($contollerName) . $this->classNameSuffix);
                break;
            default:
                if (!is_dir($this->moduleDir)) {
                    mkdir($this->moduleDir);
                } else if (!is_dir($this->moduleDir . '/' . $moduleName)) {
                    mkdir($this->moduleDir . '/' . $moduleName);
                    mkdir($this->moduleDir . '/' . $moduleName . '/controllers');
                } else if (!is_dir($this->moduleDir . '/' . $moduleName . '/controllers')) {
                    mkdir($this->moduleDir . '/' . $moduleName . '/controllers');
                }
                $this->outputFileName = $this->moduleDir . $moduleName . '//controllers/' . ucfirst($controllerName) . $this->fileNameSuffix . '.php';
                $template = require_once $this->templatePath;
                $data = sprintf($template, ucfirst($controllerName) . $this->classNameSuffix,ucfirst($controllerName) . $this->classNameSuffix);
                break;
        }


        $output->writeln([
            ucfirst($arg) . ' ' . $this->type . ' Creating',
            '============',
        ]);

        if (is_dir(dirname($this->outputFileName))) {
            if (!is_writable(dirname($this->outputFileName))) {
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
            throw new Exception('Dirctory not exists!' . dirname($this->outputFileName));
        }
    }
}