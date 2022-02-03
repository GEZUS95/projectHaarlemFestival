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
            'name' => "john doe",
            'result' => $result,
        ]);
    }

    public function jsonTest(Request $request, $year): Response
    {
        $leapYear = new LeapYear();

        if ($leapYear->isLeapYear($year)) {
            $result = 'Yep, this is a leap year!';
        } else {
            $result ='Nope, this is not a leap year.';
        }

        return $this->json(['result' => $result]);
    }
}
