<?php

namespace App\Http\Controllers;

use App\Models\Provinces;
use App\Models\Districts;
use App\Models\Regency;
use App\Models\Villages;
use Exception;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    // all data provinces
    public function get_provices()
    {
        try
        {
            if(!Provinces::exists())
            {
                return response()->json([
                    'status_code' => 503,
                    'message' => 'No Data Available.'
                ], 503);
            }

            $prov = Provinces::get();

            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => $prov
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        catch(Exception $e)
        {
            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // all data regency
    public function data_regency()
    {
        try
        {
            if(!Regency::exists())
            {
                return response()->json([
                    'status_code' => 503,
                    'message' => 'No Data Available.'
                ], 503);
            }

            $reg = Regency::get();

            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => $reg
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        catch(Exception $e)
        {
            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // get regency use provinces_id
    public function get_regency($id)
    {
        try
        {
            if(!Regency::exists())
            {
                return response()->json([
                    'status_code' => 503,
                    'message' => 'No Data Available.'
                ], 503);
            }

            $reg = Regency::with(['provinces'])
            ->where('provinces_id', $id)
            ->get();

            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => $reg
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        catch(Exception $e)
        {
            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // all data districts
    public function data_districts()
    {
        try{
            if(!Districts::exists())
            {
                return response()->json([
                    'status_code' => 503,
                    'message' => 'No Data Available.'
                ], 503);
            }

            $dis = Districts::get();

            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => $dis
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        catch(Exception $e)
        {
            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // get districts use regencies_id
    public function get_districts($id)
    {
        try
        {
            if(!Districts::exists())
            {
                return response()->json([
                    'status_code' => 503,
                    'message' => 'No Data Available.'
                ], 503);
            }

            $dis = Districts::with(['regencies'])
            ->where('regencies_id', $id)
            ->get();

            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => $dis
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        catch(Exception $e)
        {
            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // all data villages
    public function data_villages()
    {
        try
        {
            if(!Villages::exists())
            {
                return response()->json([
                    'status_code' => 503,
                    'message' => 'No Data Available.'
                ], 503);
            }

            $vil = Villages::get();
            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => $vil
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        catch(Exception $e)
        {
            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // get villages use districts
    public function get_villages($id)
    {
        try
        {
            if(!Villages::exists())
            {
                return response()->json([
                    'status_code' => 503,
                    'message' => 'No Data Available.'
                ], 503);
            }

            $vil = Villages::with(['districts'])
            ->where('districts_id', $id)
            ->get();

            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => $vil
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        catch(Exception $e)
        {
            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // select 2 get regencies
    public function select2_get_regencies(Request $request)
    {
        $search = $request->input('search', ''); // Tambahkan default value jika kosong
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 50);

        try
        {
            // Lakukan pencarian berdasarkan keyword dan paginasi
            $regencies = Regency::with(['provinces'])
            ->where('name', 'like', '%' . $search . '%')
            ->paginate($perPage, ['*'], 'page', $page);

            // Buat response sesuai format yang diharapkan Select2
            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => $regencies->items(), // Data desa/kelurahan
                'pagination' => [
                    'more' => $regencies->hasMorePages() // Memberitahu Select2 jika ada data halaman berikutnya
                ]
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        catch(Exception $e)
        {
            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // select 2 get districts
    public function select2_get_districts(Request $request)
    {
        $search = $request->input('search', ''); // Tambahkan default value jika kosong
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 50);

        try
        {
            // Lakukan pencarian berdasarkan keyword dan paginasi
            $districts = Districts::with(['regencies'])
            ->where('name', 'like', '%' . $search . '%')
            ->paginate($perPage, ['*'], 'page', $page);

            // Buat response sesuai format yang diharapkan Select2
            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => $districts->items(), // Data desa/kelurahan
                'pagination' => [
                    'more' => $districts->hasMorePages() // Memberitahu Select2 jika ada data halaman berikutnya
                ]
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        catch(Exception $e)
        {
            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // select 2 get villages
    public function select2_get_villages(Request $request)
    {
        $search = $request->input('search', ''); // Tambahkan default value jika kosong
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 20);

        try
        {
            // Lakukan pencarian berdasarkan keyword dan paginasi
            $villages = Villages::with(['districts'])
            ->where('name', 'like', '%' . $search . '%')
            ->paginate($perPage, ['*'], 'page', $page);

            // Buat response sesuai format yang diharapkan Select2
            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => $villages->items(), // Data desa/kelurahan
                'pagination' => [
                    'more' => $villages->hasMorePages() // Memberitahu Select2 jika ada data halaman berikutnya
                ]
            ], 200)->header('Access-Control-Allow-Origin', '*');
        }
        catch(Exception $e)
        {
            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
