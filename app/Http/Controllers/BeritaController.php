<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Berita;
use Carbon\Carbon;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        function populateDropdown($sumber)
        {
            return
            "<option value='".$sumber["sumber"]."'>".
            $sumber["sumber"].
            "</option>";
        }
        $listSumber = Berita::select('sumber')->groupBy('sumber')->get('sumber')->toArray();
        $render = [];
        foreach ($listSumber as $key => $sumber) {
            array_push($render, populateDropdown($sumber));
        }
        return view('berita', compact('render'));
    }

    /**
     * Mendapatkan jumlah klik berita.
     *
     * @return \Illuminate\Http\Response
     */
    public function redir(Request $req)
    {
        DB::table('berita')->where('id', $req->id)->increment('click');
        return redirect(DB::table('berita')->select('link')->where('id', $req->id)->first()->link);
    }

    /**
     * Mengelola requestd dari AJAX datatable front-end.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBeritas(Request $request)
    {
        $query = Berita::select('id', 'tag', 'sumber', 'tanggal', 'judul', 'link');
        function getIcon($sumber)
        {
            if ($sumber=="Kalteng.antaranews.com") {
                return asset('antara.ico');
            }
            if ($sumber=="Kalteng.tribunnews.com") {
                return asset('tribun.png');
            }
            if ($sumber=="Tabengan.com") {
                return asset('tabengan.png');
            }
            if ($sumber=="Kaltengekspres.com") {
                return asset('kaltengekspres.PNG');
            }
            if ($sumber=="Gerakkalteng.com") {
                return asset('gerakkalteng.png');
            }
            if ($sumber=="Katadata.co.id") {
                return asset('katadata.png');
            }
            if ($sumber=="Radar-kalteng.com") {
                return asset('radarkalteng.png');
            }
            return $sumber.".png";
        }
        function getDateFormat($tanggal)
        {
            $waktu= Carbon::parse(substr($tanggal, 0, 10));

            switch ($waktu->format('D')) {
                case 'Sun':
                    $hari_ini = "Minggu";
                break;
        
                case 'Mon':
                    $hari_ini = "Senin";
                break;
        
                case 'Tue':
                    $hari_ini = "Selasa";
                break;
        
                case 'Wed':
                    $hari_ini = "Rabu";
                break;
        
                case 'Thu':
                    $hari_ini = "Kamis";
                break;
        
                case 'Fri':
                    $hari_ini = "Jumat";
                break;
        
                case 'Sat':
                    $hari_ini = "Sabtu";
                break;
                
                default:
                    $hari_ini = "Tidak di ketahui";
                break;
            }
            return $hari_ini." ,".$waktu->format('d/M/Y');
        }
        if (!empty($request->hingga)) {
            $query = $query->whereBetween('tanggal', array($request->dari, $request->hingga));
        }
        if ($request->sumber!="*") {
            $query = $query->where('sumber', $request->sumber);
        }

        return datatables($query->orderBy('tanggal', 'DESC'))
            ->editColumn('judul', function ($berita) {
                return
                '<p style="margin-bottom:0;"><img src="'.getIcon($berita->sumber).'" style="width:13px">'.$berita->tag.' :'.getDateFormat($berita->tanggal).'</p>'.
                '<a style="font-weight:650;text-decoration:none;color:black;" href="'.route('redir', $berita->id).'"  target="_blank"> '.$berita->judul.' </a>';
            })
            ->escapeColumns([])
            ->rawColumns(['judul'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}