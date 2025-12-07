<?php
//  class car {
//    public $x;
//    public $y;

//    function set_home ($x) {
//       $this->x = $x;
//  }
//    function get_name () {
//       return $this->x;
// }



// $BMW = new car();
// $VOLVO = new car();

// $BMW -> set_name('BMW');
// $VOLVO -> set_name('VOLVO');

// echo $BMW->get_name(); =
// echo $VOLVO->get_name();

// class calculator
// {
//    public $x;
//    public $y;

//    function set_calculator($x, $y)


//    public function setCalculator($x, $y)
//    {
//       $this->x = $x;
//       $this->y = $y;



//    function get_calculator()
//    {
//       return $this->x + $this->y;
//    }
// }

// $calc = new calculator();

// $calc->set_calculator(5, 10);

// echo $calc->get_calculator();

// class
// Calculator
// {
//     public $x;
//     public $y;

//     function set_calculator($x, $y)
//     {
//         $this->x = $x;
//         $this->y = $y;
//     }

//     function get_calculator()
//     {
//         return $this->x + $this->y;
//     }
// }

// $calc = new Calculator();
// $calc->set_calculator(5, 10);
// echo $calc->get_calculator();

// class fruits{
//     public $name;
//     public $color;
// }
// $apple = new fruits();
// $banana = new fruits();
// echo $apple->name = "apple";
// echo "<br>";
// echo $banana->name = "banana";



//MAKE  CALCULATOR WITH USING PHP OOP CONCEPT 
// class Calculator
// {
//     public $x;
//     public $y;

//     function setCalculator($x, $y)
//     {
//         $this->x = $x;
//         $this->y = $y;
//     }

//     function multiplyByOne()
//     {
//         return $this->x * $this->y;
//     }

//     function multiplyByTwo()
//     {
//         return $this->x + $this->y;
//     }
//     function multiplyByThree()
//     {
//         return $this->x / $this->y;
//     }

//     function multiplyByFour()
//     {
//         return $this->x - $this->y;
//     }
// }

// $calc = new Calculator();
// $calc->setCalculator(10, 10);

// echo "MULTIPLY: " . $calc->multiplyByOne();
// echo "<br>";
// echo "ADD: " . $calc->multiplyByTwo();
// echo "<br>";
// echo "DIVIDE: " . $calc->multiplyByThree();
// echo "<br>";
// echo "SUBTRACT: " . $calc->multiplyByFour();



// OOPS CONSTRUCTOR
// class employee
// {
//     public $name;
//     public $salary;


//     function __construct($name, $salary)
//     {
//         $this->name = ($name);
//         $this->salary = ($salary);
//     }
// }

// $TUSHAR = new employee("TUSHAR", 50000);
// echo "<br>";
// $SINGH = new employee("SINGH", 60000);
// echo "<br>";
// $BISHT = new employee("BISHT", 70000);

// echo $TUSHAR->name;
// echo $TUSHAR->salary;
// echo "<br>";
// echo $SINGH->name;
// echo $SINGH->salary;
// echo "<br>";
// echo $BISHT->name;
// echo $BISHT->salary;

// DESTRUCTOR IN OOPS

// class fruit
// {
//    public $name;
//    public $color;

//    function __construct($name, $color)
//    {
//       $this->name = $name;
//       $this->color = $color;
//    }
//    function __destruct()
//    {
//       echo "THIS IS THE APPLE {$this->name} AND COLOR {$this->color} <br>";
//    }
// }

// $apple = new fruit("APPLE", "RED");



//INHERITABCE IN OOPS 

class fruit
{
   public $name;
   public $color;


   public function __construct($name, $color)
   {
      $this->name = $name;
      $this->color = $color;
   }
   public function get_name()
   {
      return $this->name;
   }
}