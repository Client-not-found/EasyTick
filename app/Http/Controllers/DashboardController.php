<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Verification;


class DashboardController extends Controller

{

    public function acp () {
        $this->authorize('view', User::class);
        return view('acp.dashboard', [
        'knowledgebase' => Page::where( "name", 'knowledgebase' )->first(),
        $licenseData = Verification::where( "key", 1 )->first(),
        'license' => $licenseData->license,
        ]);
    }

} ?>