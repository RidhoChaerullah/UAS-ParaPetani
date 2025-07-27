<?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache; // Import Cache
use Illuminate\Support\Facades\Log;   // Import Log
use Illuminate\Http\Client\RequestException; // Import untuk menangkap error HTTP

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Simpan hasil di cache selama 60 menit untuk menghindari panggilan API berulang
            $articles = Cache::remember('home_articles', 60 * 60, function () {
                $apiKey = config('services.newsapi.key');

                // Tambahkan pengecekan jika API key tidak ada
                if (!$apiKey) {
                    Log::error('NewsAPI key is not set in config/services.php or .env file.');
                    return []; // Kembalikan array kosong jika key tidak ada
                }

                $response = Http::get("https://newsapi.org/v2/everything?q=pertanian&language=id&sortBy=publishedAt&pageSize=3&apiKey=$apiKey");
                

                // Lemparkan exception jika request gagal, agar bisa ditangkap oleh blok catch
                $response->throw(); 

                return $response->json()['articles'];
            });
        } catch (RequestException $e) {
            // Tangkap error spesifik dari HTTP Client (misal: 4xx atau 5xx error)
            Log::error('Failed to fetch news from NewsAPI: ' . $e->getMessage());
            $articles = []; // Jika terjadi error, pastikan $articles tetap array kosong
        } catch (\Throwable $e) {
            // Tangkap semua jenis error lainnya (misal: masalah koneksi)
            Log::error('An unexpected error occurred: ' . $e->getMessage());
            $articles = [];
        }

        return view('home', ['articles' => $articles]);
    }
}