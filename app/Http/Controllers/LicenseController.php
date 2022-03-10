<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Verification;

use App\Models\Page;
use App\Models\Ticket;

class LicenseController extends Controller
{
    
    public function save (Request $request) {
            
        DB::table('verifications')->where('key', 1)
            ->update(['license' => $request->license,]);


        //Gehe auf die Lokale Datenbank schauen ob eine Lizenz vorhanden ist
        $licenseData = DB::table('verifications')->select('license')->first();


        if($licenseData != null) {          

            //Speiche die Lizenz in der Variabel
            $license = $licenseData->license;
            //Gehe auf die externe Datenbank schauen ob es dort einen eintrag mit dem selben Key gibt
            $licenseData = DB::connection('mysql2')->table('servers')->where('license', '=', $license)->first();

            
            if($licenseData != null) {

                //Speicher IP-Adresse in der Datenbank
                $id = $licenseData->id;

                $ip = $_SERVER["REMOTE_ADDR"];

                DB::connection('mysql2')->table('servers')->where('id', '=', $id)->update([
                    'address' => $ip,
                ]);

                //Überprüft ob key gesperrt wurde
                $status = $licenseData->active;

                if($status == true) {
                    if($licenseData == true) {

                        //Wenn Key existiert wird der Benutzer weitergeleitet
                        if($licenseData != null) {

                            //Ticket abfrage mit Admin rechten
                            if(auth()->user()->groId == 2 || auth()->user()->groId == 1 ) {
                                $this->authorize('viewAny', Ticket::class);
                                return view('ticketsystem.dashboard',[
                                    'tickets' => Ticket::all(),
                                    'countTickets' => Ticket::count(),
                
                                    'openTickets' => Ticket::where("status", "Open")->get(),
                                    'countOpenTickets' => Ticket::where("status", "Open")->count(),
                
                                    'closeTickets' => Ticket::where("status", "Close")->get(),
                                    'countClosedTickets' => Ticket::where("status", "Close")->count(),
                                    'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
                        ]); } else {
                            //Ticket abfrage für Kunden
                            $this->authorize('view', Ticket::class);
                            return view('ticketsystem.dashboard',[
                            'tickets' => Ticket::all(),
                            'countTickets' => Ticket::where('useId', auth()->user()->key)->count(),
                
                            'openTickets' => Ticket::where("status", "Open")->where('useId', auth()->user()->key)->get(),
                            'countOpenTickets' => Ticket::where("status", "Open")->where('useId', auth()->user()->key)->count(),
                
                            'closeTickets' => Ticket::where("status", "Close")->where('useId', auth()->user()->key)->get(),
                            'countClosedTickets' => Ticket::where("status", "Close")->where('useId', auth()->user()->key)->count(),
                            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
                
                        ]); }
                    } else {return view('check');}
                } else {
                    return view('check');
                }
            } else {
                return view('check');
            }
        }else {
            return view('check');
        }

        }  
    }       

    public function check () {
        //setze die Lizenz auf falsch
        $license = false;

        //Gehe auf die Lokale Datenbank schauen ob eine Lizenz vorhanden ist
        $licenseData = DB::table('verifications')->select('license')->first();

        if($licenseData != null) {
            

            //Speiche die Lizenz in der Variabel
            $license = $licenseData->license;

            $ip = $_SERVER["REMOTE_ADDR"];

            //Gehe auf die externe Datenbank schauen ob es dort einen eintrag mit dem selben Key gibt
            $licenseData = DB::connection('mysql2')->table('servers')->where('license', '=', $license)->where('address', '=', $ip)->first();
            //dd($licenseData);

            if($licenseData != null) {


                //Überprüft ob key gesperrt wurde
                $status = $licenseData->active;
                if($status == true) {
                    if($licenseData == true) {

                        //Wenn Key existiert wird der Benutzer weitergeleitet
                        if($licenseData != null) {
                            //Ticket abfrage mit Admin rechten
                            if(auth()->user()->groId == 2 || auth()->user()->groId == 1 ) {
                                $this->authorize('viewAny', Ticket::class);
                                return view('ticketsystem.dashboard',[
                                    'tickets' => Ticket::all(),
                                    'countTickets' => Ticket::count(),
                
                                    'openTickets' => Ticket::where("status", "Open")->get(),
                                    'countOpenTickets' => Ticket::where("status", "Open")->count(),
                
                                    'closeTickets' => Ticket::where("status", "Close")->get(),
                                    'countClosedTickets' => Ticket::where("status", "Close")->count(),
                                    'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),

                        ]); } else {
                            //Ticket abfrage für Kunden
                            $this->authorize('view', Ticket::class);
                            return view('ticketsystem.dashboard',[
                            'tickets' => Ticket::all(),
                            'countTickets' => Ticket::where('useId', auth()->user()->key)->count(),
                
                            'openTickets' => Ticket::where("status", "Open")->where('useId', auth()->user()->key)->get(),
                            'countOpenTickets' => Ticket::where("status", "Open")->where('useId', auth()->user()->key)->count(),
                
                            'closeTickets' => Ticket::where("status", "Close")->where('useId', auth()->user()->key)->get(),
                            'countClosedTickets' => Ticket::where("status", "Close")->where('useId', auth()->user()->key)->count(),
                            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
                        ]); }
                    } else {return view('check');}
                } else {
                    return view('check');
                }
            } else {
                return view('check');
            }
        }else {
            return view('check');
        }

        }  
    } 
}
