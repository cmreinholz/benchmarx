<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SampleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {   $revenue=db::table('responses')->selectRaw('count(CASE WHEN response BETWEEN 0 AND 100000 THEN 1 END ) as less_than_100000,
        count(CASE WHEN response BETWEEN 100001 AND 500000 THEN 1 END) as between_100001_to_500000,
        count(CASE WHEN response BETWEEN 500001 AND 1000000 THEN 1 END) as between_500001_to_1000000,
        count(CASE WHEN response BETWEEN 1000001 AND 5000000 THEN 1 END) as between_1000001_to_5000000,
        count(CASE WHEN response BETWEEN 5000001 AND 25000000 THEN 1 END) as between_5000001_to_25000000,
        count(CASE WHEN response BETWEEN 25000001 AND 100000000 THEN 1 END) as between_25000001_to_100000000')
        ->where('question_id','=', '11')
        ->where('year','=', now()->year)
        ->get();
        $chartquestion=db::table('questions')->select('question')
        ->where('id','=', '11')
        ->get();

        return Chartisan::build()
            ->labels(['Less Than 100K', '100K to 500K', '500K to 1M', '1M to 5M', '5M to 25M', '25M+'])
            ->dataset( 'Revenue', [$revenue[0]->less_than_100000,$revenue[0]->between_100001_to_500000,$revenue[0]->between_500001_to_1000000, $revenue[0]->between_1000001_to_5000000, $revenue[0]->between_5000001_to_25000000, $revenue[0]->between_25000001_to_100000000])
            ->extra(['title',$chartquestion[0]->question]);
        }
}