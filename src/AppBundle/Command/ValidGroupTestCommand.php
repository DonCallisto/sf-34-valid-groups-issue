<?php

namespace AppBundle\Command;

use AppBundle\Entity\Bar;
use AppBundle\Entity\Foo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\VarDumper\VarDumper;

class ValidGroupTestCommand extends Command
{
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:valid-group-test');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bar = new Bar('aValue', null);
        $foo = new Foo($bar);

        $errors = $this->validator->validate($foo, null, ['Bar', 'second']);
        VarDumper::dump($errors);

        $errors = $this->validator->validate(new Foo(new Bar(null, null)), null, ['Bar', 'second']);
        VarDumper::dump($errors);
    }
}