<?php

class CircleAreaLib
{
    public function getCircleArea(int $diagonal)
    {
       $area = (M_PI * $diagonal**2)/4;
       return $area;
   }
}

class SquareAreaLib
{
    public function getSquareArea(int $diagonal)
    {
        $area = ($diagonal**2)/2;
        return $area;
    }
}

interface ISquare
{
    function squareArea(int $sideSquare);
}

interface ICircle
{
    function circleArea(int $circumference);
}

class Square implements ISquare {

    function squareArea(int $sideSquare)
    {
        $area = $sideSquare**2;
        return $area;
    }
}

class SquareAdapter implements ISquare
{
    private $adaptee;

    public function __construct(SquareAreaLib $adaptee)
    {
        $this -> adaptee = $adaptee;
    }

    function squareArea(int $sideSquare)
    {
        $diagonal = round(sqrt(($sideSquare**2) * 2), 0);
        $area = $this -> adaptee -> getSquareArea($diagonal);
        return $area;
    }
}

class Circle
{
    public function circleArea(int $circumference)
    {
        $area = ($circumference**2)/(4*M_PI);
        return $area;
    }
}

class CircleAdapter implements ICircle
{
    private $adaptee;

    public function __construct(CircleAreaLib $adaptee)
    {
        $this -> adaptee = $adaptee;
    }

    public function circleArea(int $circumference)
    {
        $diagonal = round($circumference / M_PI, 0);
        $area = $this -> adaptee -> getCircleArea($diagonal);
        return $area;
    }
}

$sideSquare = 15;
$circumference = 100;

$square = new Square();
$circle = new Circle();
$squareAdapter = new SquareAdapter(new SquareAreaLib());
$circleAdapter = new CircleAdapter(new CircleAreaLib());

echo "Calculate the area of a square using the inner class:<br>";
echo "The area of a square with a side equal to " . $sideSquare . " is " . $square -> squareArea($sideSquare) . "<br>";

echo "<br>";

echo "Calculate the area of a square using the outer class:<br>";
echo "The area of a square with a side equal to " . $sideSquare . " is " . $squareAdapter -> squareArea($sideSquare) . "<br>";

echo "<br>";

echo "Calculate the area of a circle using the inner class:<br>";
echo "The area of a circle with a circumference equal to " . $circumference . " is " . $circle -> circleArea($circumference) . "<br>";

echo "<br>";

echo "Calculate the area of a circle using the outer class:<br>";
echo "The area of a circle with a circumference equal to " . $circumference . " is " . $circleAdapter -> circleArea($circumference) . "<br>";

