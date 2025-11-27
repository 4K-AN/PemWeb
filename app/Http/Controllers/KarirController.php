<?php

namespace App\Http\Controllers;

use App\Models\Fixation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class KarirController extends Controller
{
    // Fungsi untuk halaman utama (Daftar Kartu)
    public function index()
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return view('karir.Fiksasi.simulasi.index', ['fixation' => null, 'careers' => []]);
        }

        // Ambil fiksasi terbaru user
        $fixation = Auth::user()->latestFixation();

        $careers = [];

        // Jika ada fiksasi, dapatkan rekomendasi karir dari AI
        if ($fixation) {
            $careers = $this->getPersonalizedCareers($fixation);
        }

        return view('karir.Fiksasi.simulasi.index', ['fixation' => $fixation, 'careers' => $careers]);
    }

    // Fungsi untuk mendapatkan karir yang dipersonalisasi dari AI
    private function getPersonalizedCareers($fixation)
    {
        try {
            // Cek cache terlebih dahulu
            $cacheKey = 'careers_' . $fixation->id;
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }

            $apiKey = env('GEMINI_API_KEY');

            $prompt = "Berdasarkan jurusan '{$fixation->jurusan}' dengan deskripsi '{$fixation->deskripsi}',
berikan rekomendasi MINIMAL 5 karir yang BERBEDA yang paling sesuai dalam format JSON ARRAY.

PENTING:
1. Berikan MINIMAL 5 karir yang SANGAT BERBEDA satu sama lain
2. Hanya return JSON array, tanpa teks lain
3. Setiap karir harus unique dan berbeda profesi

Format HARUS:
[
  {
    \"title\": \"Nama Karir 1\",
    \"description\": \"Deskripsi singkat\",
    \"skills\": [\"skill1\", \"skill2\", \"skill3\", \"skill4\"],
    \"salary\": \"Rp X.000.000 - Rp Y.000.000\",
    \"career_path\": [\"Level1\", \"Level2\", \"Level3\", \"Level4\"],
    \"relevance\": \"Mengapa cocok\"
  },
  {
    \"title\": \"Nama Karir 2\",
    \"description\": \"Deskripsi singkat\",
    \"skills\": [\"skill1\", \"skill2\", \"skill3\", \"skill4\"],
    \"salary\": \"Rp X.000.000 - Rp Y.000.000\",
    \"career_path\": [\"Level1\", \"Level2\", \"Level3\", \"Level4\"],
    \"relevance\": \"Mengapa cocok\"
  }
]";

            $response = Http::withoutVerifying()->timeout(30)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}",
                [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.8,
                        'topK' => 40,
                        'topP' => 0.95,
                        'maxOutputTokens' => 3000,
                    ]
                ]
            );

            $result = $response->json();

            if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                $text = $result['candidates'][0]['content']['parts'][0]['text'];

                // Log full response untuk debugging
                \Log::info('AI Response Length: ' . strlen($text));
                \Log::info('AI Response: ' . $text);

                // Bersihkan teks dari markdown code blocks
                $text = preg_replace('/```json\s*/i', '', $text);
                $text = preg_replace('/```\s*/i', '', $text);
                $text = trim($text);

                // Extract JSON array - lebih robust
                if (preg_match('/\[\s*\{[\s\S]*?\}\s*\]/m', $text, $matches)) {
                    $jsonText = $matches[0];

                    \Log::info('Extracted JSON: ' . substr($jsonText, 0, 200));

                    $careers = json_decode($jsonText, true);

                    if (is_array($careers) && count($careers) > 0) {
                        \Log::info('Successfully parsed ' . count($careers) . ' careers');

                        // Cache hasil selama 24 jam
                        Cache::put($cacheKey, $careers, 86400);
                        return $careers;
                    } else {
                        \Log::warning('Parsed careers but empty: ' . json_encode($careers));
                    }
                } else {
                    \Log::warning('Could not extract JSON array from response');
                }
            } else {
                \Log::warning('No text in AI response');
            }

            // Jika AI gagal, gunakan fallback data
            \Log::warning('AI failed to return careers for fixation ' . $fixation->id . ', using fallback');
            return $this->getFallbackCareers($fixation);

        } catch (\Exception $e) {
            \Log::error('Error getting personalized careers: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return $this->getFallbackCareers($fixation);
        }
    }

    // Fallback data jika AI tidak berhasil
    private function getFallbackCareers($fixation)
    {
        // Mapping jurusan ke karir (lebih comprehensive)
        $careerMapping = [
            'Software Engineering' => [
                [
                    'title' => 'Software Engineer / Developer',
                    'description' => 'Mengembangkan perangkat lunak berkualitas tinggi dengan kode yang clean dan efisien untuk berbagai platform.',
                    'skills' => ['Programming', 'Database Design', 'API Development', 'Git Version Control', 'Testing'],
                    'salary' => 'Rp 8.000.000 - Rp 25.000.000',
                    'career_path' => ['Junior Developer', 'Mid Developer', 'Senior Developer', 'Tech Lead'],
                    'relevance' => 'Sesuai dengan keahlian teknis programming'
                ],
                [
                    'title' => 'Full Stack Developer',
                    'description' => 'Menguasai frontend dan backend untuk membangun aplikasi web lengkap dari sisi client dan server.',
                    'skills' => ['Frontend Development', 'Backend Development', 'Database Management', 'Deployment'],
                    'salary' => 'Rp 10.000.000 - Rp 30.000.000',
                    'career_path' => ['Junior Full Stack', 'Full Stack Developer', 'Senior Full Stack', 'Tech Lead'],
                    'relevance' => 'Menggabungkan skill frontend dan backend'
                ],
                [
                    'title' => 'DevOps Engineer',
                    'description' => 'Mengelola infrastruktur, deployment, dan monitoring aplikasi untuk memastikan sistem berjalan optimal.',
                    'skills' => ['Cloud Platforms', 'Containerization', 'CI/CD', 'Infrastructure as Code', 'System Administration'],
                    'salary' => 'Rp 12.000.000 - Rp 35.000.000',
                    'career_path' => ['Junior DevOps', 'DevOps Engineer', 'Senior DevOps', 'DevOps Architect'],
                    'relevance' => 'Pemanfaatan infrastruktur modern'
                ],
                [
                    'title' => 'AI/Machine Learning Engineer',
                    'description' => 'Mengembangkan sistem AI dan model machine learning untuk solusi bisnis yang intelligent.',
                    'skills' => ['Python', 'Machine Learning', 'Deep Learning', 'Data Processing', 'Model Training'],
                    'salary' => 'Rp 15.000.000 - Rp 50.000.000',
                    'career_path' => ['Junior ML Engineer', 'ML Engineer', 'Senior ML Engineer', 'ML Architect'],
                    'relevance' => 'Aplikasi AI dalam software development'
                ],
                [
                    'title' => 'Security Engineer',
                    'description' => 'Mengamankan aplikasi dan infrastruktur dari ancaman cyber dengan best practices security.',
                    'skills' => ['Network Security', 'Penetration Testing', 'Cryptography', 'Security Tools', 'Compliance'],
                    'salary' => 'Rp 10.000.000 - Rp 40.000.000',
                    'career_path' => ['Junior Security', 'Security Engineer', 'Senior Security', 'Security Architect'],
                    'relevance' => 'Keamanan dalam development'
                ]
            ],
            'Data Science' => [
                [
                    'title' => 'Data Scientist',
                    'description' => 'Menganalisis data kompleks untuk menghasilkan insight bisnis yang berharga dan actionable.',
                    'skills' => ['Python/R', 'Machine Learning', 'Statistics', 'Data Visualization', 'SQL'],
                    'salary' => 'Rp 10.000.000 - Rp 30.000.000',
                    'career_path' => ['Data Analyst', 'Data Scientist', 'Senior Data Scientist', 'Lead Data Scientist'],
                    'relevance' => 'Pemanfaatan data untuk insight'
                ],
                [
                    'title' => 'Data Engineer',
                    'description' => 'Membangun pipeline data dan infrastruktur untuk mengolah data skala besar secara efisien.',
                    'skills' => ['SQL', 'Big Data Tools', 'ETL', 'Cloud Platforms', 'Python/Scala'],
                    'salary' => 'Rp 12.000.000 - Rp 35.000.000',
                    'career_path' => ['Junior Data Engineer', 'Data Engineer', 'Senior Data Engineer', 'Lead Data Engineer'],
                    'relevance' => 'Engineering untuk data processing'
                ],
                [
                    'title' => 'Analytics Engineer',
                    'description' => 'Mengubah raw data menjadi model data yang siap untuk analisis dan reporting bisnis.',
                    'skills' => ['SQL', 'Data Modeling', 'DBT', 'Analytics Tools', 'Business Logic'],
                    'salary' => 'Rp 10.000.000 - Rp 28.000.000',
                    'career_path' => ['Junior Analytics Engineer', 'Analytics Engineer', 'Senior Analytics Engineer'],
                    'relevance' => 'Bridge antara engineering dan analytics'
                ],
                [
                    'title' => 'ML Engineer',
                    'description' => 'Mengembangkan model machine learning untuk production dan deployment di scale besar.',
                    'skills' => ['Python', 'Machine Learning', 'Data Processing', 'MLOps', 'Model Deployment'],
                    'salary' => 'Rp 15.000.000 - Rp 45.000.000',
                    'career_path' => ['Junior ML Engineer', 'ML Engineer', 'Senior ML Engineer', 'ML Architect'],
                    'relevance' => 'Machine learning applications'
                ],
                [
                    'title' => 'Business Intelligence Developer',
                    'description' => 'Membuat dashboard dan reporting system untuk mendukung keputusan bisnis.',
                    'skills' => ['BI Tools', 'SQL', 'Data Visualization', 'ETL', 'Business Analysis'],
                    'salary' => 'Rp 10.000.000 - Rp 30.000.000',
                    'career_path' => ['Junior BI Developer', 'BI Developer', 'Senior BI Developer', 'BI Architect'],
                    'relevance' => 'Data untuk business intelligence'
                ]
            ],
            'Information Technology' => [
                [
                    'title' => 'IT Infrastructure Manager',
                    'description' => 'Mengelola infrastruktur IT dan memastikan sistem berjalan stabil untuk organisasi.',
                    'skills' => ['Network Administration', 'Server Management', 'Cloud Services', 'System Security'],
                    'salary' => 'Rp 8.000.000 - Rp 25.000.000',
                    'career_path' => ['Junior IT Admin', 'IT Administrator', 'Senior IT Admin', 'IT Manager'],
                    'relevance' => 'Manajemen infrastruktur IT'
                ],
                [
                    'title' => 'Network Engineer',
                    'description' => 'Merancang dan mengelola jaringan komputer untuk konektivitas dan performa optimal.',
                    'skills' => ['Network Design', 'Router Configuration', 'Security Protocols', 'Network Monitoring'],
                    'salary' => 'Rp 8.000.000 - Rp 28.000.000',
                    'career_path' => ['Junior Network Engineer', 'Network Engineer', 'Senior Network Engineer'],
                    'relevance' => 'Infrastruktur jaringan'
                ],
                [
                    'title' => 'Systems Administrator',
                    'description' => 'Mengelola sistem server dan user untuk memastikan uptime dan performa sistem optimal.',
                    'skills' => ['Linux/Windows', 'System Management', 'User Support', 'Automation'],
                    'salary' => 'Rp 7.000.000 - Rp 23.000.000',
                    'career_path' => ['Junior SysAdmin', 'Systems Administrator', 'Senior SysAdmin'],
                    'relevance' => 'Manajemen sistem'
                ],
                [
                    'title' => 'Cloud Architect',
                    'description' => 'Merancang solusi cloud yang scalable dan cost-effective untuk kebutuhan bisnis.',
                    'skills' => ['Cloud Platforms', 'Architecture Design', 'Security', 'Cost Optimization'],
                    'salary' => 'Rp 15.000.000 - Rp 40.000.000',
                    'career_path' => ['Cloud Engineer', 'Senior Cloud Engineer', 'Cloud Architect'],
                    'relevance' => 'Arsitektur cloud infrastructure'
                ],
                [
                    'title' => 'IT Security Officer',
                    'description' => 'Mengawasi dan mengimplementasikan kebijakan keamanan IT untuk melindungi aset organisasi.',
                    'skills' => ['Security Audit', 'Risk Management', 'Compliance', 'Security Tools'],
                    'salary' => 'Rp 10.000.000 - Rp 35.000.000',
                    'career_path' => ['Security Analyst', 'IT Security Officer', 'Chief Security Officer'],
                    'relevance' => 'Keamanan informasi'
                ]
            ],
            'Ilmu Pengetahuan Sosial' => [
                [
                    'title' => 'Konsultan Bisnis',
                    'description' => 'Memberikan saran strategis kepada perusahaan untuk meningkatkan efisiensi dan profitabilitas bisnis.',
                    'skills' => ['Business Analysis', 'Strategic Planning', 'Data Analysis', 'Communication', 'Problem Solving'],
                    'salary' => 'Rp 10.000.000 - Rp 35.000.000',
                    'career_path' => ['Junior Consultant', 'Business Consultant', 'Senior Consultant', 'Consulting Manager'],
                    'relevance' => 'Analisis sosial dan bisnis dari sudut pandang IPS'
                ],
                [
                    'title' => 'Analis Kebijakan Publik',
                    'description' => 'Menganalisis dan merancang kebijakan publik untuk meningkatkan pelayanan pemerintahan dan kesejahteraan masyarakat.',
                    'skills' => ['Policy Analysis', 'Research', 'Data Interpretation', 'Report Writing', 'Stakeholder Management'],
                    'salary' => 'Rp 8.000.000 - Rp 25.000.000',
                    'career_path' => ['Junior Analyst', 'Policy Analyst', 'Senior Analyst', 'Policy Director'],
                    'relevance' => 'Aplikasi IPS dalam kebijakan publik'
                ],
                [
                    'title' => 'Peneliti Sosial',
                    'description' => 'Melakukan penelitian mendalam tentang fenomena sosial untuk menghasilkan insights yang bermakna.',
                    'skills' => ['Research Methodology', 'Data Collection', 'Analysis', 'Report Writing', 'Critical Thinking'],
                    'salary' => 'Rp 7.000.000 - Rp 22.000.000',
                    'career_path' => ['Research Assistant', 'Social Researcher', 'Senior Researcher', 'Research Director'],
                    'relevance' => 'Penelitian sosial adalah inti dari IPS'
                ],
                [
                    'title' => 'Spesialis Sumber Daya Manusia',
                    'description' => 'Mengelola aspek kemanusiaan dalam organisasi termasuk rekrutmen, pengembangan, dan kesejahteraan karyawan.',
                    'skills' => ['HR Management', 'Recruitment', 'Employee Relations', 'Training Development', 'Payroll Management'],
                    'salary' => 'Rp 8.000.000 - Rp 28.000.000',
                    'career_path' => ['HR Officer', 'HR Specialist', 'HR Manager', 'HR Director'],
                    'relevance' => 'Pengelolaan manusia dan organisasi'
                ],
                [
                    'title' => 'Jurnalis / Media Professional',
                    'description' => 'Mengumpulkan, menganalisis, dan mempublikasikan informasi untuk memberikan pencerahan kepada masyarakat.',
                    'skills' => ['Journalism', 'Research', 'Writing', 'Communication', 'Critical Analysis'],
                    'salary' => 'Rp 7.000.000 - Rp 25.000.000',
                    'career_path' => ['Reporter', 'Journalist', 'Senior Journalist', 'Editor/Producer'],
                    'relevance' => 'Komunikasi dan informasi dari perspektif sosial'
                ]
            ],
            'Ilmu Pengetahuan Alam' => [
                [
                    'title' => 'Research Scientist',
                    'description' => 'Melakukan penelitian ilmiah untuk mengembangkan pengetahuan dan teknologi baru di berbagai bidang sains.',
                    'skills' => ['Scientific Research', 'Laboratory Work', 'Data Analysis', 'Technical Writing', 'Problem Solving'],
                    'salary' => 'Rp 10.000.000 - Rp 35.000.000',
                    'career_path' => ['Research Assistant', 'Research Scientist', 'Senior Scientist', 'Research Director'],
                    'relevance' => 'Penelitian ilmiah fundamental dari IPA'
                ],
                [
                    'title' => 'Engineer Teknis',
                    'description' => 'Merancang dan mengembangkan solusi teknis untuk memecahkan masalah engineering praktis.',
                    'skills' => ['Technical Design', 'Problem Analysis', 'Project Management', 'CAD Software', 'Testing'],
                    'salary' => 'Rp 9.000.000 - Rp 32.000.000',
                    'career_path' => ['Junior Engineer', 'Technical Engineer', 'Senior Engineer', 'Engineering Manager'],
                    'relevance' => 'Aplikasi IPA dalam engineering'
                ],
                [
                    'title' => 'Scientist Laboratorium',
                    'description' => 'Melakukan tes dan analisis laboratorium untuk kontrol kualitas dan pengembangan produk industri.',
                    'skills' => ['Laboratory Analysis', 'Quality Control', 'Chemical Testing', 'Data Interpretation', 'Safety Protocols'],
                    'salary' => 'Rp 7.000.000 - Rp 22.000.000',
                    'career_path' => ['Lab Technician', 'Lab Scientist', 'Senior Lab Scientist', 'Lab Manager'],
                    'relevance' => 'Pekerjaan laboratorium dan analisis'
                ],
                [
                    'title' => 'Quality Assurance Specialist',
                    'description' => 'Memastikan produk dan proses manufaktur memenuhi standar kualitas yang ditetapkan.',
                    'skills' => ['Quality Testing', 'Process Analysis', 'Documentation', 'Problem Solving', 'Standards Knowledge'],
                    'salary' => 'Rp 7.500.000 - Rp 24.000.000',
                    'career_path' => ['QA Technician', 'QA Specialist', 'Senior QA', 'QA Manager'],
                    'relevance' => 'Kontrol kualitas dan standardisasi'
                ],
                [
                    'title' => 'Environmental Specialist',
                    'description' => 'Mengelola dampak lingkungan dan memastikan kepatuhan terhadap regulasi lingkungan.',
                    'skills' => ['Environmental Analysis', 'Regulation Knowledge', 'Data Analysis', 'Report Writing', 'Project Management'],
                    'salary' => 'Rp 8.000.000 - Rp 28.000.000',
                    'career_path' => ['Environmental Officer', 'Environmental Specialist', 'Senior Specialist', 'Environmental Manager'],
                    'relevance' => 'Pengelolaan lingkungan berbasis sains'
                ]
            ],
            'Bisnis / Ekonomi' => [
                [
                    'title' => 'Business Analyst',
                    'description' => 'Menganalisis operasi bisnis dan mengidentifikasi peluang improvement untuk meningkatkan profitabilitas.',
                    'skills' => ['Business Analysis', 'Financial Analysis', 'Data Interpretation', 'Process Improvement', 'Reporting'],
                    'salary' => 'Rp 8.000.000 - Rp 30.000.000',
                    'career_path' => ['Junior Analyst', 'Business Analyst', 'Senior Analyst', 'Business Manager'],
                    'relevance' => 'Analisis bisnis dan ekonomi'
                ],
                [
                    'title' => 'Finance Manager',
                    'description' => 'Mengelola sumber daya keuangan perusahaan dan memastikan kesehatan finansial organisasi.',
                    'skills' => ['Financial Management', 'Budgeting', 'Financial Analysis', 'Strategic Planning', 'Compliance'],
                    'salary' => 'Rp 10.000.000 - Rp 40.000.000',
                    'career_path' => ['Financial Analyst', 'Finance Officer', 'Finance Manager', 'Finance Director'],
                    'relevance' => 'Manajemen keuangan perusahaan'
                ],
                [
                    'title' => 'Marketing Manager',
                    'description' => 'Merencanakan dan mengeksekusi strategi pemasaran untuk meningkatkan brand awareness dan penjualan.',
                    'skills' => ['Marketing Strategy', 'Market Analysis', 'Campaign Management', 'Consumer Psychology', 'Analytics'],
                    'salary' => 'Rp 9.000.000 - Rp 35.000.000',
                    'career_path' => ['Marketing Officer', 'Marketing Manager', 'Senior Manager', 'Marketing Director'],
                    'relevance' => 'Pemasaran dan strategi bisnis'
                ],
                [
                    'title' => 'Operations Manager',
                    'description' => 'Mengelola operasional bisnis sehari-hari untuk memastikan efisiensi dan produktivitas maksimal.',
                    'skills' => ['Operations Management', 'Process Optimization', 'Team Management', 'Problem Solving', 'Planning'],
                    'salary' => 'Rp 8.500.000 - Rp 32.000.000',
                    'career_path' => ['Operations Officer', 'Operations Manager', 'Senior Manager', 'Operations Director'],
                    'relevance' => 'Manajemen operasional bisnis'
                ],
                [
                    'title' => 'Investment Analyst',
                    'description' => 'Menganalisis peluang investasi dan memberikan rekomendasi untuk mengoptimalkan return investasi.',
                    'skills' => ['Financial Analysis', 'Investment Research', 'Market Analysis', 'Risk Assessment', 'Modeling'],
                    'salary' => 'Rp 10.000.000 - Rp 40.000.000',
                    'career_path' => ['Junior Analyst', 'Investment Analyst', 'Senior Analyst', 'Investment Manager'],
                    'relevance' => 'Analisis investasi dan pasar finansial'
                ]
            ],
            'Hukum / Ilmu Hukum' => [
                [
                    'title' => 'Lawyer / Advokat',
                    'description' => 'Memberikan nasihat hukum dan mewakili klien dalam berbagai kasus perdata dan pidana.',
                    'skills' => ['Legal Research', 'Case Analysis', 'Negotiation', 'Court Representation', 'Legal Writing'],
                    'salary' => 'Rp 10.000.000 - Rp 50.000.000',
                    'career_path' => ['Junior Lawyer', 'Lawyer', 'Senior Lawyer', 'Law Firm Partner'],
                    'relevance' => 'Praktik hukum profesional'
                ],
                [
                    'title' => 'Legal Consultant',
                    'description' => 'Memberikan konsultasi hukum kepada organisasi untuk kepatuhan regulasi dan manajemen risiko hukum.',
                    'skills' => ['Legal Knowledge', 'Compliance', 'Risk Analysis', 'Consulting', 'Negotiation'],
                    'salary' => 'Rp 9.000.000 - Rp 35.000.000',
                    'career_path' => ['Legal Officer', 'Legal Consultant', 'Senior Consultant', 'Consulting Manager'],
                    'relevance' => 'Konsultasi hukum korporat'
                ],
                [
                    'title' => 'Compliance Officer',
                    'description' => 'Memastikan organisasi patuh terhadap semua hukum dan regulasi yang berlaku.',
                    'skills' => ['Compliance Knowledge', 'Audit', 'Risk Management', 'Documentation', 'Reporting'],
                    'salary' => 'Rp 8.000.000 - Rp 28.000.000',
                    'career_path' => ['Compliance Officer', 'Senior Compliance', 'Compliance Manager'],
                    'relevance' => 'Kepatuhan dan manajemen risiko hukum'
                ],
                [
                    'title' => 'Notary / Notaris',
                    'description' => 'Memberikan layanan notarial untuk dokumen resmi dan transaksi hukum.',
                    'skills' => ['Legal Documentation', 'Notary Procedures', 'Client Relations', 'Record Keeping', 'Ethics'],
                    'salary' => 'Rp 8.000.000 - Rp 30.000.000',
                    'career_path' => ['Legal Assistant', 'Notary', 'Senior Notary'],
                    'relevance' => 'Layanan notarial dan dokumentasi hukum'
                ],
                [
                    'title' => 'Legal Researcher',
                    'description' => 'Melakukan penelitian hukum mendalam untuk mendukung proses litigasi dan pemberian nasihat hukum.',
                    'skills' => ['Legal Research', 'Analysis', 'Writing', 'Citation', 'Critical Thinking'],
                    'salary' => 'Rp 7.000.000 - Rp 24.000.000',
                    'career_path' => ['Legal Research Assistant', 'Legal Researcher', 'Senior Researcher'],
                    'relevance' => 'Penelitian hukum dan analisis'
                ]
            ]
        ];

        // Default careers jika jurusan tidak match
        $defaultCareers = [
            [
                'title' => 'Professional Consultant',
                'description' => 'Memberikan konsultasi profesional dalam bidang keahlian untuk membantu organisasi mencapai tujuan.',
                'skills' => ['Analysis', 'Problem Solving', 'Communication', 'Strategic Thinking', 'Research'],
                'salary' => 'Rp 9.000.000 - Rp 30.000.000',
                'career_path' => ['Junior Consultant', 'Consultant', 'Senior Consultant', 'Manager'],
                'relevance' => 'Konsultasi profesional umum'
            ],
            [
                'title' => 'Project Manager',
                'description' => 'Merencanakan dan mengelola proyek untuk memastikan deliverables tercapai tepat waktu dan budget.',
                'skills' => ['Project Planning', 'Team Management', 'Risk Management', 'Communication', 'Leadership'],
                'salary' => 'Rp 10.000.000 - Rp 35.000.000',
                'career_path' => ['Assistant PM', 'Project Manager', 'Senior PM', 'Program Director'],
                'relevance' => 'Manajemen proyek lintas industri'
            ],
            [
                'title' => 'Analyst',
                'description' => 'Menganalisis data dan proses untuk mengidentifikasi insights dan peluang improvement.',
                'skills' => ['Data Analysis', 'Research', 'Critical Thinking', 'Problem Solving', 'Reporting'],
                'salary' => 'Rp 7.000.000 - Rp 25.000.000',
                'career_path' => ['Junior Analyst', 'Analyst', 'Senior Analyst', 'Analysis Manager'],
                'relevance' => 'Analisis umum di berbagai industri'
            ],
            [
                'title' => 'Operations Specialist',
                'description' => 'Mengoptimalkan operasional dan proses bisnis untuk meningkatkan efisiensi dan produktivitas.',
                'skills' => ['Process Optimization', 'Analysis', 'Project Management', 'Documentation', 'Training'],
                'salary' => 'Rp 7.500.000 - Rp 26.000.000',
                'career_path' => ['Operations Officer', 'Operations Specialist', 'Operations Manager'],
                'relevance' => 'Optimasi operasional'
            ],
            [
                'title' => 'Training & Development Specialist',
                'description' => 'Mengembangkan dan mengelola program pelatihan untuk meningkatkan kompetensi karyawan.',
                'skills' => ['Curriculum Design', 'Training Delivery', 'Needs Assessment', 'Evaluation', 'Communication'],
                'salary' => 'Rp 7.000.000 - Rp 24.000.000',
                'career_path' => ['Training Officer', 'L&D Specialist', 'Senior Specialist', 'L&D Manager'],
                'relevance' => 'Pengembangan sumber daya manusia'
            ]
        ];

        return $careerMapping[$fixation->jurusan] ?? $defaultCareers;
    }

    // Fungsi untuk halaman Detail Karir
    public function show($slug)
    {
        // DATA LENGKAP UNTUK SEMUA PROFESI (fallback jika needed)
        $jobs = [
            'software-engineer' => [
                'title' => 'Software Engineer / Developer',
                'icon' => 'Code',
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
                'icon' => 'BarChart',
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
                'icon' => 'Cloud',
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
                'icon' => 'Lock',
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
                'icon' => 'Brain',
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
                'icon' => 'Palette',
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
                'icon' => 'Briefcase',
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
                'icon' => 'Globe',
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

        // KIRIM DATA KE VIEW
        return view('karir.Fiksasi.simulasi.detail', [
            'job' => $jobs[$slug]
        ]);
    }
}
