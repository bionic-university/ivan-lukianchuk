<?php

final class Calculator
{
    /**
     * Error codes
     */
    const ERROR_NO = 0;
    const ERROR_ARGS = 1;
    const ERROR_DIVISION_BY_ZERO = 2;

    protected $firstOperand;
    protected $secondOperand;
    protected $operator;
    protected $result;
    protected $error;
    protected $messages = array(
        self::ERROR_NO => 'Results: ',
        self::ERROR_ARGS => 'ERROR: incorrect input. Please use next format: [operand1][operator][operand2] f.e. 1+2',
        self::ERROR_DIVISION_BY_ZERO => 'ERROR: Division by Zero'
    );

    function __construct()
    {
        $this->init();
        if ($this->error == self::ERROR_NO) {
            $this->calculate();
        }
        $this->output();
    }

    protected function init()
    {
        if ((count($_SERVER['argv']) != 2) || !preg_match('/^\d+[\+|\-|\*|\/]?\d+$/', $_SERVER['argv'][1], $matches)) {
            $this->error = self::ERROR_ARGS;
        } else {
            list($this->firstOperand, $this->operator, $this->secondOperand) = preg_split('/([\+\-\*\/]{1})/',
                $_SERVER['argv'][1], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            if ($this->secondOperand == '0') {
                $this->error = self::ERROR_DIVISION_BY_ZERO;
            } else {
                $this->error = self::ERROR_NO;
            }
        }
    }

    protected function calculate()
    {
        switch ($this->operator) {
            case '+': {
                $this->result = $this->firstOperand + $this->secondOperand;
                break;
            }
            case '-': {
                $this->result = $this->firstOperand - $this->secondOperand;
                break;
            }
            case '*': {
                $this->result = $this->firstOperand * $this->secondOperand;
                break;
            }
            case '/': {
                $this->result = $this->firstOperand / $this->secondOperand;
            }
        }
    }

    protected function output()
    {
        if ($this->error != self::ERROR_NO) {
            echo $this->messages[$this->error] . PHP_EOL;
        } else {
            echo $this->messages[self::ERROR_NO] . $this->result . PHP_EOL;
        }
    }
}

new Calculator();



