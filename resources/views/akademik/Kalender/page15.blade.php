@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-green-50 relative overflow-hidden font-sans">
    
    <div class="absolute top-0 left-0 w-full h-full z-0 pointer-events-none">
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute top-40 right-0 w-96 h-96 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <svg class="absolute bottom-0 w-full text-green-800 opacity-10" viewBox="0 0 1440 320" fill="currentColor">
            <path fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,197.3C1248,171,1344,149,1392,138.7L1440,128V320H1392C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320H0Z"></path>
        </svg>
    </div>
    

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-6">

        <div class="absolute top-24 left-4 md:left-20">
            <a href="#" class="w-10 h-10 rounded-full border border-green-600 flex items-center justify-center text-green-800 hover:bg-green-600 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
        </div>

        <div class="flex flex-col lg:flex-row items-center justify-center gap-16 mt-8">

            <div class="bg-gray-900 text-gray-300 rounded-3xl p-8 shadow-2xl w-full max-w-md border border-gray-700">
                
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-white text-2xl font-bold">March <span class="font-light text-gray-400">2025</span></h2>
                    <div class="flex gap-4">
                        <button class="hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                        <button class="hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
                    </div>
                </div>

                <div class="grid grid-cols-7 gap-y-4 text-center text-sm font-medium mb-4">
                    {{-- <div class="text-gray-500">Su</div> --}} <div class="text-gray-600">27</div><div class="text-gray-600">28</div><div>1</div><div>2</div><div>3</div><div>4</div><div>5</div>
                    
                    <div>6</div><div>7</div><div>8</div><div>9</div><div>10</div><div>11</div><div>12</div>
                    
                    <div>13</div><div>14</div>
                    <div class="relative flex items-center justify-center">
                        <span class="w-8 h-8 rounded-full bg-teal-500 text-gray-900 font-bold flex items-center justify-center shadow-[0_0_15px_rgba(20,184,166,0.5)]">15</span>
                    </div>
                    <div>16</div><div>17</div><div>18</div><div>19</div>
                    
                    <div>20</div><div>21</div><div>22</div><div>23</div><div>24</div><div>25</div><div>26</div>
                    
                    <div>27</div><div>28</div><div>29</div><div>30</div><div>31</div><div class="text-gray-600">1</div><div class="text-gray-600">2</div>
                </div>
            </div>

            <div class="relative">
                <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[3rem] p-8 shadow-2xl w-full max-w-sm flex flex-col items-center text-center h-[500px]">
                    
                    <h1 class="text-[10rem] leading-none font-black text-transparent bg-clip-text bg-gradient-to-b from-gray-700 to-transparent opacity-80 -mt-4 mb-4">
                        15
                    </h1>

                    <div class="w-full space-y-4 relative z-10 -mt-16">
                        
                        <div class="bg-[#5a8c76] text-white rounded-2xl p-4 flex items-center gap-4 shadow-lg transform hover:scale-105 transition duration-300">
                            <div class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">1</div>
                            <span class="text-left text-sm font-medium">Hari Perempuan Internasional</span>
                        </div>

                        <div class="bg-[#5a8c76] text-white rounded-2xl p-4 flex items-center gap-4 shadow-lg transform hover:scale-105 transition duration-300">
                            <div class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shrink-0">2</div>
                            <span class="text-left text-sm font-medium">Beasiswa Bakti Madiun Selatan</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="flex justify-center mt-12">
            <button class="bg-gradient-to-r from-[#5a8c76] to-[#4a7c66] text-white font-bold py-3 px-12 rounded-full shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition duration-300 border border-white/20">
                Set Reminder
            </button>
        </div>

        <div class="text-center mt-8 text-green-800 text-xs font-bold opacity-60">
            © - Copyright by Edvizo.
        </div>

    </div>
</div>
@endsection