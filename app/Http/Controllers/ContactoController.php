<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Contacto;

class ContactoController extends Controller
{
    public function enviar_correo(Request $request){

    	/*
    	Mail::send(['text' => 'mails.contacto'], ['name', 'Roely'], function($message){
    		$message->to('gerson.roely@gmail.com', 'To Bitfumes')->subject('Prueba');
    		$message->from('gerson.roely@gmail.com');
    	});
    	*/

    	\Mail::to('colegiosinai.z24@gmail.com')->send(new Contacto($request));

    }
}
