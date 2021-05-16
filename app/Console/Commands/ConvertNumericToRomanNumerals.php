<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConvertNumericToRomanNumerals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:numeric_to_roman_numerals
                            {--numeric= : Integer value to be converted (1 to 999,999)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converts numeric to roman numerals';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function numericToRoman($integer)
    {
        // Convert the integer into an integer (just to make sure)
        $integer = intval($integer);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );

        foreach($lookup as $roman => $value){
            // Determine the number of matches
            $matches = intval($integer/$value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman,$matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
        }

        // The Roman numeral should be built then return it
        return $result;
    }

    /**
     * Execute the console command.
     *
     * @return string
     */
    public function handle()
    {
        $numeric = $this->option('numeric');

        if (intval($numeric) < 1 || intval($numeric) > 999999) {
            echo 'Numeric option should be in range of 1 to 999,999';
            return;
        }

        echo $this->numericToRoman($numeric);
    }
}
