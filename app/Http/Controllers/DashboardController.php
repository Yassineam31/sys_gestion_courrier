<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Configurer Carbon pour utiliser la locale arabe
        Carbon::setLocale('ar');
        
        // Obtenir la date actuelle et la formater
        $currentDate = Carbon::now()->translatedFormat('l j F Y');

        // Passer la date formatée à la vue
        return view('dashboard', compact('currentDate'));
    }
}
