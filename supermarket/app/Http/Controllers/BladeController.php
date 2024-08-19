<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BladeController extends Controller
{
    public $data = [];
    public function index()
    {
        $this->data['dataArr'] = [
            'Tran Vu Huynh Duc',
            'Pham Huu Thien',
            'Nguyen Da Da'
        ];
        $this->data['check'] = true;
        $this->data['message'] = '<h1> Hello!</h1>';
        $this->data['index'] = 0;
        return view('Blade', $this->data);
    }
}
