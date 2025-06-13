<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        
        $articles = [
            [
                'id' => 1,
                'title' => 'Memahami Bahasa Kucing: Panduan Lengkap',
                'excerpt' => 'Pelajari berbagai gerakan, suara, dan ekspresi kucing serta artinya.',
                'image' => 'public\storage\kenalikucing.webp',  
                'date' => now(),
                'category' => 'Perilaku Kucing',
                'author' => 'Admin Pawtopia'
                
            ],
            [
                'id' => 2,
                'title' => '7 Fakta Menarik Kucing Oranye yang Jarang Diketahui',
                'excerpt' => 'Kucing oranye atau yang sering disebut \'kucing oyen\' memiliki beberapa fakta unik...',
                'image' => 'public\storage\kenalikucing.webp',  
                'date' => '2023-11-08',
                'category' => 'Fakta Kucing',
                'author' => 'Bisnis.com',
                'external_url' => 'https://kumparan.com/seputar-hobi/7-fakta-unik-tentang-kucing-yang-jarang-diketahui-24EWR6Q0aRa'
                
            ],
          
        ];

        $categories = ['Perilaku Kucing', 'Kesehatan', 'Fakta Kucing', 'Perawatan'];

        return view('articles.index', compact('articles', 'categories'));
    }

    public function show($id)
    {
        
        $article = [
            'id' => $id,
            'title' => 'Memahami Bahasa Tubuh Kucing',
            'content' => '<p>Kucing berkomunikasi dengan berbagai cara, dan memahami bahasa tubuh mereka adalah kunci untuk membangun hubungan yang kuat dengan teman kucing Anda.</p>
                          <p>Ketika kucing menyapa Anda dengan ekornya terangkat tinggi, itu adalah tanda kepercayaan diri dan kepuasan. Ekor yang bergerak cepat, di sisi lain, sering menunjukkan kejengkelan atau kegembiraan, tergantung pada kecepatan dan intensitas gerakan.</p>
                          <p>Telinga kucing juga sangat ekspresif. Telinga yang menghadap ke depan menandakan ketertarikan dan kewaspadaan, sementara telinga yang mendatar menunjukkan ketakutan atau agresi.</p>
                          <p>Posisi kumis kucing dapat memberi tahu Anda banyak hal tentang suasana hati mereka. Kumis yang rileks yang mengarah ke luar menandakan kucing yang tenang dan puas, sementara kumis yang ditarik ke belakang terhadap wajah mungkin menandakan ketakutan atau kecemasan.</p>
                          <p>Memahami isyarat halus ini akan membantu Anda merespons dengan tepat kebutuhan kucing Anda dan membangun kepercayaan seiring waktu.</p>',
            'image' => 'articles/cat-body-language.jpg',
            'date' => '2023-10-15',
            'category' => 'Perilaku Kucing',
            'author' => 'dr. Sarah Johnson, Pakar Perilaku Kucing'
        ];

        $relatedArticles = [
            [
                'id' => 2,
                'title' => 'Mengapa Kucing Mengepal',
                'excerpt' => 'Jelajahi alasan di balik perilaku umum kucing ini.',
                'image' => 'articles/cat-kneading.jpg',
                'date' => '2023-09-05',
                'category' => 'Perilaku Kucing'
            ],
            [
                'id' => 3,
                'title' => 'Memahami Mengeong Kucing',
                'excerpt' => 'Apa yang kucing Anda coba katakan dengan vokalisasi yang berbeda.',
                'image' => 'articles/cat-meowing.jpg',
                'date' => '2023-08-12',
                'category' => 'Perilaku Kucing'
            ],
        ];

        
        if ($id === 'external-article') {
            $article = [
                'id' => 'external-article',
                'title' => 'public\storage\kenalikucing.webp',
                'content' => 'Content preview from the article...',
                'image' => 'https://images.bisnis.com/posts/2023/11/08/1715478/kucing-oyen.jpg',
                'date' => '2023-11-08',
                'category' => 'Fakta Kucing',
                'author' => 'Bisnis.com',
                'external_url' => 'https://kumparan.com/seputar-hobi/7-fakta-unik-tentang-kucing-yang-jarang-diketahui-24EWR6Q0aRa'
            ];
        }

        
        $relatedArticles = [
            
            [
                'id' => 3,
                'title' => 'Cara Merawat Anak Kucing',
                'image' => 'kitten-care.jpg',
                'date' => now()->subDays(5),
            ],
            
            [
                'id' => 'external-2',
                'title' => 'Penelitian: Kucing Mampu Memahami Ucapan Pemiliknya',
                'image' => 'https://asset.kompas.com/crops/i8g2AnZZgDUUFR3GNP68-z_UdBk=/0x0:1280x853/750x500/data/photo/2023/10/19/653129f54c412.jpg',
                'date' => '2023-10-19',
                'external_url' => 'https://www.kompas.com/sains/read/2023/10/19/190300123/penelitian-kucing-bisa-kenali-suara-pemiliknya-dan-memahami-ucapannya'
            ],
        ];

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
