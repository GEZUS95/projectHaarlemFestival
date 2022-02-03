<?php

namespace Http\Controller;

use Http\Model\LeapYear;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController extends BaseController
{
    public function index(Request $request, $year): Response
    {
        $leapYear = new LeapYear();

        if ($leapYear->isLeapYear($year)) {
            $result = 'Yep, this is a leap year!';
        } else {
            $result ='Nope, this is not a leap year.';
        }

        return $this->render('hello', [
            // this array defines the variables passed to the template,
            // where the key is the variable name and the value is the variable value
            // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
            'name' => "john doe",
            'result' => $result,
        ]);
    }
}
