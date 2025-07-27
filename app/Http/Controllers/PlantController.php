<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // ✅ 1. PASTIKAN BARIS INI ADA
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PlantController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $plants = $user->plants()->orderBy('planted_at', 'desc')->get();
        $weatherForecast = null; // Ganti nama variabel agar lebih jelas

        $apiKey = config('services.openweather.key');
        // Pastikan user memiliki lokasi yang telah di-set
        if ($user->location && $apiKey) {
            $response = Http::get("https://api.openweathermap.org/data/2.5/forecast?q={$user->location}&lang=id&appid={$apiKey}&units=metric");

            if ($response->successful()) {
                $weatherData = $response->json();

                // ✅ LOGIKA BARU: Proses data untuk ringkasan 24 jam
                $forecasts_24h = array_slice($weatherData['list'], 0, 8); // Ambil 8 data (24 jam)

                $temps = array_column(array_column($forecasts_24h, 'main'), 'temp');
                $will_rain = false;
                $rain_time = null;
                $dominant_weather = null;

                foreach ($forecasts_24h as $forecast) {
                    // Cek apakah akan hujan (ID 5xx adalah hujan)
                    if (str_starts_with($forecast['weather'][0]['id'], '5')) {
                        $will_rain = true;
                        // Catat waktu pertama kali hujan
                        if (!$rain_time) {
                            $rain_time = $forecast['dt_txt'];
                        }
                    }
                }

                // Ambil cuaca dominan dari 6 jam ke depan untuk ringkasan
                if (isset($forecasts_24h[2])) {
                    $dominant_weather = $forecasts_24h[2]['weather'][0];
                }

                // Susun data yang rapi untuk dikirim ke view
                $weatherForecast = [
                    'city_name' => $weatherData['city']['name'],
                    'list' => $forecasts_24h,
                    'summary' => [
                        'min_temp' => round(min($temps)),
                        'max_temp' => round(max($temps)),
                        'will_rain' => $will_rain,
                        'rain_time' => $rain_time,
                        'dominant_weather' => $dominant_weather,
                    ]
                ];
            }
        }

        return view('tanaman.index', [
            'plants' => $plants,
            'weather' => $weatherForecast // Kirim data yang sudah diolah
        ]);
    }

    // ... (method store dan destroy tidak berubah)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:padi,jagung',
        ]);

        $request->user()->plants()->create([
            'name' => $request->name,
            'type' => $request->type,
            'planted_at' => now(),
        ]);

        return redirect()->route('plants.index')->with('success', 'Tanaman berhasil ditambahkan!');
    }


    public function destroy(Plant $plant)
    {
        $this->authorize('delete', $plant);
        $plant->delete();
        return redirect()->route('plants.index')->with('status', 'Tanaman berhasil dihapus.');
    }
}
