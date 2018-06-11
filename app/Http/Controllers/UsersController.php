<?php

namespace App\Http\Controllers;

use App\User;	// si se usa un modelo se añade al controlador
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($username){
    	// condicion de filtro donde username en la tabla corresponde al enviado por parametro
   		$user = User::where('username', $username)->first();

   		return view('users.show',[
   			'user' => $user,
   		]);
    }

}
