<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function showCalculator(Request $request)
    {
        $a = $request->a;
        $b = $request->b;

        $cal = $request->cal;
        $result = '';
        switch ($cal) {
            case '+':
                $result = $a + $b;
                break;
            case '-':
                $result = $a - $b;
                break;
            case '*':
                $result = $a * $b;
                break;
            case '/':
                if ($b == 0) {
                    return redirect()->back()->with('error', 'Cannot divide by zero');
                }
                $result = $a / $b;
                break;
            default:
                return redirect()->back()->with('error', 'Invalid operator');
        }


        return view('calculator2')->with([
            'result' => $result,
            'a' => $a,
            'b' => $b,
        ]);
    }
}
