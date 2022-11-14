<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Atendimento;

class AtendimentoController extends Controller
{
    public function index(){

      $atendimento = Atendimento::all() ;
      
      return view('home',['atendimento' => $atendimento]);
    }
}
