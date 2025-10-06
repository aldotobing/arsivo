<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controllers_main extends Controller
{
    //
    public function home(){
        return view('home');
    }

    public function dropdown(){
        $data = array();
        $data['data_selected'][0]['value'] = '4000';
        $data['data_selected'][0]['name'] = 'Basah';
        $data['data_selected'][1]['value'] = '5000';
        $data['data_selected'][1]['name'] = 'Kering';
        $data['data_selected'][2]['value'] = '6500';
        $data['data_selected'][2]['name'] = 'Kering Strika';
        $data['data_selected'][3]['value'] = '5000';
        $data['data_selected'][3]['name'] = 'Strika';
        
        
        $data['data_grid'][0]['id'] = '1011';
        $data['data_grid'][0]['alamat'] = 'Jl Kejawan';
        return view('dropdown', $data);
    }
}
