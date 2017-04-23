<?php
namespace App\Http\Controllers;

use \App\Http\Controllers\Controller;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HomeController extends Controller{
 
    public function index(){
        
        return view("welcome");
    }
    
}