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

    public function p2R2()
    {
        return view('web.repo.table.p2-r2');
    }

    public function p4R1()
    {
        return view('web.repo.table.p4-r1');
    }

    // secound card
    public function p4R2()
    {
        return view('web.repo.table.p4-r2');
    }

    public function p6R1()
    {
        return view('web.repo.table.p6-r1');
    }

    public function p6R2()
    {
        return view('web.repo.table.p6-r2');
    }

    public function p8R1()
    {
        return view('web.repo.table.p8-r1');
    }

    public function p8R2()
    {
        return view('web.repo.table.p8-r2');
    }

    public function p10R1()
    {
        return view('web.repo.table.p10-r1');
    }
    public function p11()
    {
        return view('web.repo.table.p11');
    }
}
