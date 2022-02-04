<?php

namespace Http\Controller;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

use Http\Model\LeapYear;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(Request $request, $year): Response
    {
        $leapYear = new LeapYear();

        if ($leapYear->isLeapYear($year)) {
            $result = 'Yep, this is a leap year!';
        } else {
            $result ='Nope, this is not a leap year.';
        }

        $r = Capsule::table('users')->where('name', '=', "john doe")->first();

        return $this->render('hello', [
            'name' => "john doe",
            'result' => $r,
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
