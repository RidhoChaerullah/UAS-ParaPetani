<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman "Tentang Kami".
     */
    public function about()
    {
        // Siapkan data tim di sini agar mudah diubah
        $team = [
            [
                'name' => 'Ridho Chaerullah',
                'role' => 'Full Stack Developer',
                'imageUrl' => asset('./img/ridho.jpg'),
                'linkedinUrl' => 'https://www.linkedin.com/in/ridho-chaerullah/',
            ],
            [
                'name' => 'Viana Salsabila Fairuz Syahla',
                'role' => 'Project Manager',
                'imageUrl' => asset('./img/viana.jpg'),
                'linkedinUrl' => 'https://www.linkedin.com/in/vianasalsabilafairuzsyahla/',
            ],
            [
                'name' => 'Fakhrul Fauzi Nugraha Tarigan',
                'role' => 'Fixer & Debugger',
                'imageUrl' => asset('./img/fauzi.jpg'),
                'linkedinUrl' => 'https://www.linkedin.com/in/fakhrul-fauzi-nugraha-tarigan-0ba608307/',
            ],
            [
                'name' => 'Muhammad Hanief Febriansyah',
                'role' => 'UI/UX Designer',
                'imageUrl' => asset('./img/hanip.jpg'),
                'linkedinUrl' => 'https://www.linkedin.com/in/hanieffebriansyah/',
            ],
        ];

        return view('pages.about', [
            'team' => $team,
        ]);
    }
}