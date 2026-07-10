<?php

namespace App\Http\Controllers\Topkar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
//use Response;

use App\Models\Topkar\District;
use App\Models\Topkar\District1926;
use App\Models\Topkar\Event;
use App\Models\Topkar\Lang;
use App\Models\Topkar\Region;
use App\Models\Topkar\Selsovet1926;
use App\Models\Topkar\Settlement;
use App\Models\Topkar\Settlement1926;
use App\Models\Topkar\Toponym;

use App\Models\Topkar\Geotype;
use App\Models\Topkar\EthnosTerritory;
use App\Models\Topkar\EtymologyNation;
use App\Models\Topkar\Informant;
use App\Models\Topkar\Recorder;
use App\Models\Topkar\Source;
use App\Models\Topkar\Struct;
use App\Models\Topkar\Structhier;

class ToponymController extends Controller
{
    public $url_args = [];
    public $args_by_get = '';

    /**
     * Instantiate a new new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->url_args = Toponym::urlArgs($request);

        $this->args_by_get = search_values_by_URL($this->url_args);
    }

    /**
     * Display toponyms.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url_args = $this->url_args;
        $nladoga_districts = Toponym::nLadogaDistricts;
        $nladoga_region1926 = Toponym::nLadogaRegion1926;
        $args_by_get = search_values_by_URL($url_args);

        $toponyms = Toponym::search($url_args);
        //        if (empty($url_args['search_districts']) || !array_intersect($url_args['search_districts'], $nladoga_districts)!=$url_args['search_districts']) {
        $toponyms = $toponyms->whereIn('district_id', $nladoga_districts);
        //            $url_args['search_districts'] = [];
        //        }

        $n_records = $toponyms->count();
        $toponyms = $toponyms->paginate($this->url_args['portion']);

        $geotype_values = Geotype::getList();
        $district_values = array_intersect_key(District::getList(), array_flip($nladoga_districts)); // array_flip() превращает массив ключей в ассоциативный массив (['key1' => 0, 'key2' => 1, ...]), и array_intersect_key() оставляет в getList() только те элементы, у которых ключ есть в nladoga_districts.
        $district1926_values = District1926::getList(false, $nladoga_region1926);
        $selsovet1926_values = Selsovet1926::getList(false, $nladoga_region1926);
        $settlement_values = Settlement::getList();
        $settlement1926_values = Settlement1926::getList();
        $sort_values = Toponym::sortList();
        $source_values = ['' => NULL] + Source::getList(true);

        return view(
            'dict.toponyms.nladoga',
            compact(
                'district_values',
                'district1926_values',
                'geotype_values',
                'nladoga_region1926',
                'selsovet1926_values',
                'settlement_values',
                'settlement1926_values',
                'sort_values',
                'source_values',
                'toponyms',
                'n_records',
                'args_by_get',
                'url_args'
            )
        );
    }

    public function onMap()
    {
        $url_args = $this->url_args;
        $url_args['search_districts'] = Toponym::nLadogaDistricts;
        if (empty($url_args['map_height'])) {
            $url_args['map_height'] = 1000;
        }
        $args_by_get = search_values_by_URL($url_args);
        $limit = 3000;


        list($total_rec, $show_count, $objs, $limit, $bounds, $url_args)
            = Toponym::forMap($limit, $url_args);
        //dd($total_rec);
        //        $district_values = District::getList();
        $nladoga_region1926 = Toponym::nLadogaRegion1926;
        $district_values = array_intersect_key(District::getList(), array_flip(Toponym::nLadogaDistricts));
        $district1926_values = District1926::getList(false, $nladoga_region1926);
        $selsovet1926_values = Selsovet1926::getList(false, $nladoga_region1926);
        $settlement1926_values = Settlement1926::getList();
        $geotype_values = Geotype::getList();
        $settlement_values = Settlement::getList();
        $sort_values = Toponym::sortList();
        $source_values = ['' => NULL] + Source::getList(true);

        return view(
            'dict.toponyms.on_map',
            compact(
                'bounds',
                'district_values',
                'district1926_values',
                'geotype_values',
                'objs',
                'limit',
                'nladoga_region1926',
                'selsovet1926_values',
                'settlement_values',
                'settlement1926_values',
                'show_count',
                'sort_values',
                'source_values',
                'total_rec',
                'args_by_get',
                'url_args'
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Toponym $toponym)
    {
        $args_by_get = $this->args_by_get;
        return view(
            'dict.toponyms.show',
            compact('toponym', 'args_by_get')
        );
    }


}
