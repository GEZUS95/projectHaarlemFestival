<?php

namespace  App\Http\Controller;

use App\Model\User;
use Exception;

use App\Model\LeapYear;
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

//        $r = Capsule::table('user')->where('id', '=', "1")->first();

        $r = User::query()->where('id', '=', "1")->first();

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
