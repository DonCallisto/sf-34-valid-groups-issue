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

        $errors = $this->validator->validate($foo);
        VarDumper::dump($errors); // correct

        $errors = $this->validator->validate($foo, null, ['Bar']);
        VarDumper::dump($errors); // expected to have only an error with PP `foo.second` (wrong!)
        // I know that `Bar` is not `Default` but there's no way to obtain this case :(

        $errors = $this->validator->validate(new Foo(new Bar(null, null)), null, ['Bar']);
        VarDumper::dump($errors); // expected to have only an error with PP `foo.first` (correct)
    }
}