<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstateStatsController extends Controller
{
    public function index($id)
    {

        $estate = Estate::findOrFail($id);
        $views = [];


        for ($i = 1; $i < 13; $i++) {
            $stats = DB::select("SELECT  `estate_id`, COUNT(`guest_ip`) as 'ViewsCount' FROM `views` WHERE MONTH(date) = $i AND `estate_id` = $estate->id  GROUP BY `estate_id`");

            if (count($stats) > 0) {
                $views[$i]['mese'] = $i;
                $views[$i]['views'] = $stats[0]->ViewsCount;
            } else {
                $views[$i]['mese'] = $i;
                $views[$i]['views'] = 0;
            }
        }

        // dd($views);


        return view('user.stats.index', compact('views', 'estate'));
    }
}
