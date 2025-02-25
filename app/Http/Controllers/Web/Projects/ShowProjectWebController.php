<?php

namespace App\Http\Controllers\Web\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowProjectWebController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        ray("ShowProjectWebController", $id);
        return view('app.projects.show');
    }
}
