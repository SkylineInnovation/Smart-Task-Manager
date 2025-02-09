<?php

namespace App\Http\Controllers\Repo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewRepoController extends Controller
{
    public function repoIndex()
    {
        return view('Web.repo.new-repo-page');
    }


    public function  p1R1()
    {
        return view('web.repo.table.p1-r1');
    }

    public function p2R1()
    {
        return view('web.repo.table.p2-r1');
    }
}
