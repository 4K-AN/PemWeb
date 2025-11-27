@extends('layouts.app')

@section('title', $job['title'] . ' - Edvizor')

@section('styles')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(180deg, #ffffff 0%, #e8f5e9 40%, #cce3de 100%);
    }

    .hero-section {
        background: linear-gradient(135deg, #5fa383 0%, #4a7c66 100%);
        padding: 80px 20px;
        margin-bottom: 40px;
        border-radius: 0 0 30px 30px;
    }

    .hero-icon {
        font-size: 80px;
        text-align: center;
        margin-bottom: 20px;
    }

    .hero-title {
        color: white;
        font-size: 48px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
    }

    .content-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(74, 124, 102, 0.15);
    }

    .section-title {
        color: #2f5d48;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .skill-item {
        background: #e8f5e9;
        padding: 12px 20px;
        border-radius: 10px;
        margin-bottom: 10px;
        border-left: 4px solid #4a7c66;
    }

    .career-step {
        background: linear-gradient(90deg, #f0fdf4, #dcfce7);
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .step-number {
        background: #4a7c66;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .back-btn {
        background: linear-gradient(135deg, #4a7c66, #2f5d48);
        color: white;
        padding: 12px 30px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        transition: transform 0.3s;
    }

    .back-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(74, 124, 102, 0.3);
    }
</style>
@endsection

@section('content')
<div class="hero-section">
    <div class="hero-icon">{{ $job['icon'] }}</div>
    <h1 class="hero-title">{{ $job['title'] }}</h1>
</div>



<div class="container mx-auto px-4 max-w-4xl pb-20">
    
    <!-- Deskripsi -->
    <div class="content-card">
        <h2 class="section-title">📝 Deskripsi Pekerjaan</h2>
        <p class="text-gray-700 text-base leading-relaxed">{{ $job['description'] }}</p>
    </div>

    <!-- Skills -->
    <div class="content-card">
        <h2 class="section-title">🛠️ Skills yang Dibutuhkan</h2>
        <div class="space-y-2">
            @foreach($job['skills'] as $skill)
                <div class="skill-item">
                    <span class="text-gray-800 font-medium">✓ {{ $skill }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Salary -->
    <div class="content-card">
        <h2 class="section-title">💰 Range Gaji</h2>
        <div class="bg-green-50 p-6 rounded-xl border-2 border-green-200">
            <p class="text-2xl font-bold text-green-800">{{ $job['salary'] }}</p>
            <p class="text-sm text-gray-600 mt-2">*Estimasi gaji di Indonesia</p>
        </div>
    </div>

    <!-- Career Path -->
    <div class="content-card">
        <h2 class="section-title">🚀 Jenjang Karir</h2>
        <div class="space-y-3">
            @foreach($job['career_path'] as $index => $step)
                <div class="career-step">
                    <div class="step-number">{{ $index + 1 }}</div>
                    <span class="text-gray-800 font-medium">{{ $step }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center">
        <a href="{{ route('karir.simulasi') }}" class="back-btn">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Profesi
        </a>
    </div>

</div>
@endsection