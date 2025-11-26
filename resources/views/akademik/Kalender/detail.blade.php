@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Kegiatan Tanggal {{ $day }}</h1>
        <p>Belum ada kegiatan khusus yang diatur untuk tanggal ini.</p>
        <a href="{{ url('/kalender-akademik') }}">Kembali ke Kalender</a>
    </div>
@endsection