<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Menampilkan halaman daftar berita.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil API key dari file .env.
        // Pastikan Anda sudah menambahkannya di file .env
        $apiKey = env('NEWS_API_KEY');

        if (!$apiKey) {
            // Jika API key tidak ada, catat error dan tampilkan halaman dengan pesan error.
            Log::error('NEWS_API_KEY not set in .env file.');
            return view('news.index', [
                'articles' => [],
                'error' => 'Konfigurasi API berita belum diatur. Silakan hubungi administrator.'
            ]);
        }
        
        // Tentukan kata kunci pencarian.
        // Jika ada input 'search' dari user, gunakan itu.
        // Jika tidak, gunakan 'pertanian' sebagai default.
        $searchQuery = $request->input('search', 'pertanian');

        // Lakukan panggilan ke NewsAPI menggunakan Laravel HTTP Client.
        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => $searchQuery,
            'language' => 'id',
            'sortBy' => 'publishedAt',
            'apiKey' => $apiKey,
            'pageSize' => 12 // Ambil 12 berita per halaman
        ]);

        $articles = [];
        $error = null;

        // Periksa apakah request berhasil (status code 2xx).
        if ($response->successful()) {
            $data = $response->json();
            // Ambil hanya array 'articles' dari respons.
            $articles = $data['articles'];

            // Ubah format tanggal untuk setiap artikel agar lebih mudah dibaca.
            foreach ($articles as &$article) {
                // Konversi tanggal UTC ke format Indonesia (misal: 21 Juli 2024)
                $article['formattedDate'] = Carbon::parse($article['publishedAt'])->translatedFormat('d F Y');
            }

        } else {
            // Jika request gagal, catat error dan siapkan pesan untuk ditampilkan.
            $errorData = $response->json();
            $errorMessage = $errorData['message'] ?? 'Gagal mengambil data berita.';
            Log::error('NewsAPI request failed: ' . $response->body());
            $error = "Terjadi kesalahan: " . $errorMessage;
        }

        // Kirim data berita, pesan error (jika ada), dan query pencarian ke view.
        return view('news.index', [
            'articles' => $articles,
            'error' => $error,
            'query' => $searchQuery
        ]);
    }
}
