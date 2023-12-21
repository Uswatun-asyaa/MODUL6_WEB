<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAnggotaRequest;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Resources\AnggotaResource;
use App\Http\Resources\AnggotaCollection;
use App\Models\anggota; // Adjust the model name to match your model
use Illuminate\Http\Request;
use Exception;

class AnggotaController extends Controller
{
    public function index()
    {
        try {
            $queryData = Anggota::all();
            $formattedDatas = new AnggotaCollection($queryData);

            return response()->json([
                'success' => true,
                'data' => $formattedDatas,
                'message' => 'Data retrieved successfully'
        
            ], 200);
        } catch (Exception $e) {
            $errorResponse = [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
            return response()->json($errorResponse);
        
        }
    }
    public function store(StoreAnggotaRequest $request)
{
    $validatedRequest = $request->validated();

    try {
        $anggota = new anggota(); // Buat instance baru dari model
        $anggota->fill($validatedRequest); // Isi instance dengan data yang divalidasi

        // Simpan data ke database
        $anggota->save();

        $formattedData = new AnggotaResource($anggota);

        return response()->json([
            'success' => true,
            'data' => $formattedData,
            'message' => 'Data retrieved successfully'
        ], 200);
    } catch (Exception $e) {
        return response()->json($e->getMessage(), 400);
    }
}

    public function show(string $id)
    {
        try {
            $member = Anggota::findOrFail($id);
            $formattedMember = new AnggotaResource($member);

            return response()->json([
                'berhasil',
                'data' => $formattedMember,
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(UpdateAnggotaRequest $request, string $id)
    {
        $validatedRequest = $request->validated();

        try {
            $member = Anggota::findOrFail($id);
            $member->update($validatedRequest);
            $member->save();

            $formattedMember = new AnggotaResource($member);

            return response()->json([
                'Berhasil',
                'data' => $formattedMember,
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            $member = Anggota::findOrFail($id);
            $member->delete();

            return response()->json([
                'message' => 'success',
                'data' => $member,
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
