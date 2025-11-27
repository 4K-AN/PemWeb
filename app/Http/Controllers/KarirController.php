<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KarirController extends Controller
{
    // Fungsi untuk halaman utama (Daftar Kartu)
    public function index()
    {
        return view('karir.Fiksasi.simulasi.index'); 
    }

    // Fungsi untuk halaman Detail
    public function show($slug)
    {
        // DATA LENGKAP UNTUK SEMUA PROFESI
        $jobs = [
            'software-engineer' => [
                'title' => 'Software Engineer / Developer',
                'icon' => '💻',
                'description' => 'Software Engineer bertanggung jawab merancang, mengembangkan, dan memelihara perangkat lunak. Mereka menulis kode yang bersih, efisien, dan dapat diuji untuk membangun aplikasi web, mobile, atau desktop.',
                'skills' => [
                    'HTML, CSS, JavaScript (Frontend)',
                    'PHP/Laravel, Node.js, atau Java (Backend)',
                    'Database Management (SQL/NoSQL)',
                    'Version Control (Git)',
                    'System Architecture Design'
                ],
                'salary' => 'Rp 8.000.000 - Rp 25.000.000',
                'career_path' => [
                    'Junior Developer (0-2 tahun)',
                    'Mid Developer (3-5 tahun)',
                    'Senior Developer (5-8 tahun)',
                    'Tech Lead / Engineering Manager (8+ tahun)'
                ]
            ],
            'data-scientist' => [
                'title' => 'Data Scientist / Data Analyst',
                'icon' => '📊',
                'description' => 'Data Scientist menganalisis data untuk menghasilkan insight bisnis. Mereka menggunakan statistik, machine learning, dan visualisasi data untuk membantu perusahaan membuat keputusan berbasis data.',
                'skills' => [
                    'Python / R untuk analisis data',
                    'SQL untuk query database',
                    'Statistics & Probability',
                    'Data Visualization (Tableau, Power BI)',
                    'Machine Learning Basics'
                ],
                'salary' => 'Rp 10.000.000 - Rp 30.000.000',
                'career_path' => [
                    'Junior Data Analyst (0-2 tahun)',
                    'Data Analyst (2-4 tahun)',
                    'Data Scientist (4-7 tahun)',
                    'Lead Data Scientist (7+ tahun)'
                ]
            ],
            'cloud-engineer' => [
                'title' => 'Cloud Engineer / DevOps Engineer',
                'icon' => '☁️',
                'description' => 'Cloud Engineer mengelola infrastruktur cloud dan memastikan aplikasi berjalan dengan efisien. Mereka mengotomatisasi deployment, monitoring, dan scaling aplikasi menggunakan teknologi cloud modern.',
                'skills' => [
                    'AWS / Google Cloud / Azure',
                    'Docker & Kubernetes',
                    'CI/CD Pipeline (Jenkins, GitLab CI)',
                    'Infrastructure as Code (Terraform)',
                    'Linux System Administration'
                ],
                'salary' => 'Rp 12.000.000 - Rp 35.000.000',
                'career_path' => [
                    'Junior DevOps (0-2 tahun)',
                    'DevOps Engineer (2-5 tahun)',
                    'Senior DevOps (5-8 tahun)',
                    'DevOps Architect (8+ tahun)'
                ]
            ],
            'cybersecurity' => [
                'title' => 'Cybersecurity Specialist',
                'icon' => '🔒',
                'description' => 'Cybersecurity Specialist melindungi sistem dan data dari serangan cyber. Mereka mengidentifikasi kerentanan, melakukan penetration testing, dan mengimplementasikan security best practices.',
                'skills' => [
                    'Network Security & Firewalls',
                    'Penetration Testing',
                    'Security Tools (Nmap, Wireshark, Metasploit)',
                    'Cryptography',
                    'Security Compliance (ISO 27001)'
                ],
                'salary' => 'Rp 10.000.000 - Rp 40.000.000',
                'career_path' => [
                    'Junior Security Analyst (0-2 tahun)',
                    'Security Engineer (2-5 tahun)',
                    'Senior Security Engineer (5-8 tahun)',
                    'Security Architect (8+ tahun)'
                ]
            ],
            'ai-engineer' => [
                'title' => 'AI Engineer / Machine Learning Engineer',
                'icon' => '🤖',
                'description' => 'AI Engineer mengembangkan sistem yang mampu belajar dan berpikir seperti manusia menggunakan algoritma pembelajaran mesin. Mereka membangun model yang dapat melakukan klasifikasi, prediksi, hingga pengenalan gambar dan suara.',
                'skills' => [
                    'Python (TensorFlow, PyTorch, Scikit-learn)',
                    'Data Preprocessing & Feature Engineering',
                    'Linear Algebra & Calculus',
                    'Model Deployment (ML Ops)',
                    'Big Data Tools (Spark, Hadoop)'
                ],
                'salary' => 'Rp 15.000.000 - Rp 50.000.000',
                'career_path' => [
                    'Junior ML Engineer (0-2 tahun)',
                    'ML Engineer (2-5 tahun)',
                    'Senior ML Engineer (5-8 tahun)',
                    'ML Architect / Research Scientist (8+ tahun)'
                ]
            ],
            'uiux-designer' => [
                'title' => 'UI/UX Designer (Tech-Oriented)',
                'icon' => '🎨',
                'description' => 'UI/UX Designer merancang pengalaman pengguna yang intuitif dan menarik. Mereka menggabungkan psikologi, desain visual, dan pemahaman teknis untuk menciptakan interface yang user-friendly.',
                'skills' => [
                    'Figma / Adobe XD / Sketch',
                    'User Research & Usability Testing',
                    'Wireframing & Prototyping',
                    'HTML/CSS Basics',
                    'Design Systems & Component Libraries'
                ],
                'salary' => 'Rp 7.000.000 - Rp 25.000.000',
                'career_path' => [
                    'Junior UI/UX Designer (0-2 tahun)',
                    'UI/UX Designer (2-5 tahun)',
                    'Senior UI/UX Designer (5-8 tahun)',
                    'Lead Designer / Design Manager (8+ tahun)'
                ]
            ],
            'product-manager' => [
                'title' => 'Product Manager (Tech Product)',
                'icon' => '📱',
                'description' => 'Product Manager memimpin pengembangan produk dari ide hingga peluncuran. Mereka menggabungkan pemahaman bisnis, teknis, dan user needs untuk menciptakan produk yang sukses di pasar.',
                'skills' => [
                    'Product Strategy & Roadmapping',
                    'User Story & Requirements Writing',
                    'Data Analysis & Metrics',
                    'Technical Understanding (APIs, Databases)',
                    'Stakeholder Management'
                ],
                'salary' => 'Rp 15.000.000 - Rp 45.000.000',
                'career_path' => [
                    'Associate Product Manager (0-2 tahun)',
                    'Product Manager (2-5 tahun)',
                    'Senior Product Manager (5-8 tahun)',
                    'Director of Product (8+ tahun)'
                ]
            ],
            'fullstack-developer' => [
                'title' => 'Full Stack Developer',
                'icon' => '🌐',
                'description' => 'Full Stack Developer menguasai frontend dan backend development. Mereka dapat membangun aplikasi web lengkap dari database hingga user interface.',
                'skills' => [
                    'Frontend (React, Vue, atau Angular)',
                    'Backend (Node.js, PHP, Python)',
                    'Database Design & Management',
                    'RESTful API Development',
                    'Deployment & Hosting'
                ],
                'salary' => 'Rp 10.000.000 - Rp 30.000.000',
                'career_path' => [
                    'Junior Full Stack (0-2 tahun)',
                    'Full Stack Developer (2-5 tahun)',
                    'Senior Full Stack (5-8 tahun)',
                    'Tech Lead (8+ tahun)'
                ]
            ],
        ];

        // CEK APAKAH SLUG ADA DI DATA
        if (!array_key_exists($slug, $jobs)) {
            abort(404);
        }

        // KIRIM DATA KE VIEW - PERHATIKAN NAMA FILE: detail1.blade.php
        return view('karir.Fiksasi.simulasi.detail', [
            'job' => $jobs[$slug]
        ]);
    }
}