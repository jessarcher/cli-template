<?php

use App\GreetCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class GreetCommandTest extends TestCase
{
    public function setUp()
    {
        $this->greetCommand = new GreetCommand;
        $this->commandTester = new CommandTester($this->greetCommand);

        parent::setUp();
    }

    public function test_it_greets()
    {
        $this->commandTester->execute([
            'name' => 'Jess',
        ]);

        $output = $this->commandTester->getDisplay();

        $this->assertContains('Hello, Jess.', $output);
    }

    public function test_it_yells()
    {
        $this->commandTester->execute([
            'name' => 'Jess',
            '--yell' => true,
        ]);

        $output = $this->commandTester->getDisplay();

        $this->assertContains('HELLO, JESS!!!', $output);
    }

    public function test_it_customises_the_greeting()
    {
        $this->commandTester->execute([
            'name' => 'Jess',
            '--greeting' => 'G\'day',
        ]);

        $output = $this->commandTester->getDisplay();

        $this->assertContains('G\'day, Jess.', $output);
    }

    public function test_it_handles_no_name()
    {
        $this->expectException(RuntimeException::class);

        $this->commandTester->execute([]);
    }
}
