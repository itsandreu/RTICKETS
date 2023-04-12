<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;

class DashboardController extends Controller
{
    //

    public function dashboard(){
        $usersCount = User::count();
        $usersDisabled = User::onlyTrashed()->count();
        $ticketscount = Ticket::count();
        $ticketsabiertos = Ticket::where('id_estado',1)->count();
        $ticketsenproceso = Ticket::where('id_estado',2)->count();
        $ticketscerrados = Ticket::where('id_estado',3)->count();
        
        return view('dashboard.inicio')->with('usersCount',$usersCount)
                                    ->with('usersDisabled',$usersDisabled)
                                    ->with('ticketscount',$ticketscount)
                                    ->with('ticketsabiertos',$ticketsabiertos)
                                    ->with('ticketsenproceso',$ticketsenproceso)
                                    ->with('ticketscerrados',$ticketscerrados);
    }
}
