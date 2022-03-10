o9<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Page;

class DepartementController extends Controller
{
    public function admin() {
        $this->authorize('create', User::class);
        return view('acp.departements',[
            'departements' => Departement::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
            ]);
    }

    public function departementDetails(Request $request, int $id)
    {
        $this->authorize('create', User::class);
        return view('acp.departementdetails', [
            'departement' => Departement::where( "key", $id )->first(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);

    }

    public function newDepartement () {
        $this->authorize('create', User::class);
        return view('acp.newdepartement', [
        'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }

    public function acpEdit ( Request $request, int $id ) {
        $this->authorize('update', Departement::class);
        $request->validate([
            'departement' => 'required',
            'active' => 'required',
        ]);

        DB::table('departements')
            ->where('key', '=', $request->id)
            ->update(['name' => $request->departement,
            'active' => $request->active]);

        return view('acp.departements',[
            'departements' => Departement::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);

    }

    public function acpDelete ( Request $request, int $id ) {
        $this->authorize('delete', Departement::class);
        DB::table('departements')->where('key', '=', $request->id )->delete();

        return view('acp.departements',[
            'departements' => Departement::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }

    public function acpSave ( Request $request ) {
        //dd($request);
        $this->authorize('create', Departement::class);
        Departement::create([
            'name' => $request->departement,
            'active' => $request->active,
        ]);

        return view('acp.departements',[
            'departements' => Departement::all(),
            'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        ]);
    }
}
