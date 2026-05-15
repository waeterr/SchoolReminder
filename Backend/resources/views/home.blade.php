<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Reminder - Home Student</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .hero-bg-wave {
            background: url('');
            /* GANTI NANTI DENGAN WAVY SHAPE BAWAH */
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* Splash */
        .fade {
            transition: opacity 0.8s ease-in-out;
        }

        @keyframes fadeSplash {

            0%,
            100% {
                opacity: 0;
            }

            10%,
            90% {
                opacity: 1;
            }
        }

        .splash-animate {
            animation: fadeSplash 2.5s ease-in-out forwards;
        }
    </style>
</head>

<body class="bg-white min-h-screen flex flex-col overflow-x-hidden">

    <!-- SPLASH SCREEN -->
    <div id="splash" class="fixed inset-0 flex flex-col items-center justify-center bg-white z-50 splash-animate">
        <img src="{{'images/logo.png'}}" alt="School Reminder Logo" class="h-10">
        <h1 class="text-2xl font-semibold text-[#1B2A4E] mt-3">School Reminder</h1>
    </div>

    <!-- MAIN CONTENT -->
    <div id="main" class="hidden">

        <!-- NAVBAR -->
        <nav class="w-full flex justify-between items-center px-10 py-4 shadow-sm">
            <div class="flex items-center space-x-2">

                <!-- LOGO -->
                <div class="w-10 h-10 bg-gray-300 rounded-md">
                    <img src="{{'images/logo.png'}}" alt="School Reminder Logo" class="h-10">
                </div>


                <h1 class="font-semibold text-[#1B2A4E] text-lg">
                    School <span class="text-[#3A71C1]">Reminder</span>
                </h1>
            </div>

            <div class="hidden md:flex space-x-7 text-[#1B2A4E] font-medium">
                <a href="{{ route('homestudent') }}" class="text-white bg-[#3A71C1] px-4 py-1 rounded-full">Home</a>
                <a href="{{ route('task') }}" class="hover:text-[#3A71C1]">Task</a>
                <a href="{{ route('calendar') }}" class="hover:text-[#3A71C1]">Calendar</a>
                <a href="#" class="hover:text-[#3A71C1]">Features</a>
                <a href="#" class="hover:text-[#3A71C1]">Contact Us</a>
            </div>

            <div class="flex items-center space-x-3">
                <span id="sr-username" class="hidden text-sm font-medium text-[#1B2A4E]"></span>
                <a href="#"
                    class="border border-[#3A71C1] px-4 py-1 rounded-full hover:bg-[#3A71C1] hover:text-white transition">
                    Sign In
                </a>
                <a href="#" class="bg-[#1B2A4E] text-white px-4 py-1 rounded-full hover:opacity-80 transition">
                    Log In
                </a>
            </div>
        </nav>

        <!-- HERO SECTION -->
        <section class="px-10 mt-20 flex flex-col md:flex-row items-center justify-between">

            <!-- LEFT TEXT -->
            <div class="max-w-xl">
                <div class="flex items-center gap-2 bg-[#3A71C1] text-white rounded-full px-4 py-1 w-fit">
                    <!-- ICON roket ganti manual -->
                    <div class="w-4 h-4 bg-white rounded-full"></div>
                    <!-- ganti pakai <img src=""> -->
                    <span>No. 1 platform for learning</span>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-black mt-4 leading-tight">
                    The Best Partner to <br> Reach Fluency
                </h1>

                <p class="text-gray-700 text-md mt-4 leading-relaxed">
                    As an e-learning platform which facilitate two-way
                    interaction between students and teachers,
                    SchoolReminder enables you to learn anywhere.
                </p>
            </div>


            <div class="mt-10 md:mt-0 md:ml-10">

                <img src="{{ asset('images/hero-image.png') }}" alt="Hero Image"
                    class="w-[330px] h-[330px] object-cover rounded-lg">

            </div>
        </section>

        <section class="bg-[#1A2E4F] w-full py-16 mt-20">

            <h2 class="text-center text-white text-2xl font-semibold mb-10">
                Our Service
            </h2>

            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-6">

                <!-- CARD 1 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 text-center shadow-md">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-gradient-to-b from-white to-gray-300 flex items-center justify-center shadow">
                        <img src="{{ asset('images/classplanner.png') }}" alt="ClassPlanner" class="w-8">
                    </div>
                    <p class="text-white font-semibold mt-4">ClassPlanner</p>
                    <p class="text-gray-300 text-sm mt-2">Atur, ubah, dan kelola jadwal pelajaran siswa!</p>
                </div>

                <!-- CARD 2 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 text-center shadow-md">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-gradient-to-b from-white to-gray-300 flex items-center justify-center shadow">
                        <img src="{{ asset('images/bell.png') }}" alt="Bell" class="w-8">
                    </div>
                    <p class="#1E505E font-semibold mt-4">DeadlineBuzz</p>
                    <p class="text-gray-300 text-sm mt-2">Reminder otomatis disaat dekat deadline tugas siswa!</p>
                </div>

                <!-- CARD 3 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 text-center shadow-md">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-gradient-to-b from-white to-gray-300 flex items-center justify-center shadow">
                        <img src="{{ asset('images/teacher.png') }}" alt="Teacher" class="w-8">
                    </div>
                    <p class="text-white font-semibold mt-4">TeacherTask</p>
                    <p class="text-gray-300 text-sm mt-2">Tempat untuk para guru memberikan tugas / ujian</p>
                </div>

                <!-- CARD 4 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 text-center shadow-md">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-gradient-to-b from-white to-gray-300 flex items-center justify-center shadow">
                        <img src="{{ asset('images/book.png') }}" alt="Book" class="w-8">
                    </div>
                    <p class="text-white font-semibold mt-4">MyTaskBook</p>
                    <p class="text-gray-300 text-sm mt-2">Tempat siswa mengelola tugas sebelum deadline menyerang</p>
                </div>

                <!-- CARD 5 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 text-center shadow-md">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-gradient-to-b from-white to-gray-300 flex items-center justify-center shadow">
                        <img src="{{ asset('images/alert.png') }}" alt="Alert" class="w-8">
                    </div>
                    <p class="text-white font-semibold mt-4">PingAlert</p>
                    <p class="text-gray-300 text-sm mt-2">Notifikasi cepat buat tugas yang kelewat</p>
                </div>

                <!-- CARD 6 -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 text-center shadow-md">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-gradient-to-b from-white to-gray-300 flex items-center justify-center shadow">
                        <img src="{{ asset('images/history.png') }}" alt="History" class="w-8">
                    </div>
                    <p class="text-white font-semibold mt-4">HistoryLine</p>
                    <p class="text-gray-300 text-sm mt-2">Tempat menyimpan semua aktivitas guru atau pun siswa</p>
                </div>

            </div>
        </section>
        <!-- DEADLINE SECTION -->
        <section class="px-10 mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- CARD 1 -->
                <div class="bg-white shadow-lg rounded-2xl p-6">
                    <p class="font-semibold text-red-600">Do it now</p>
                    <h3 class="text-xl font-bold mt-1">Deadline Alert</h3>
                    <p class="text-sm text-gray-700 mt-3">
                        Task : Essay PAI <br>
                        Deadline : Tomorrow <br>
                        Progress : Not done
                    </p>
                    <button class="mt-4 bg-[#1B2A4E] text-white px-4 py-1 rounded-lg">
                        View Task
                    </button>
                </div>

                <!-- CARD 2 -->
                <div class="bg-white shadow-lg rounded-2xl p-6">
                    <p class="font-semibold text-yellow-600">Do it immediately</p>
                    <h3 class="text-xl font-bold mt-1">Last Minute Tasks</h3>
                    <p class="text-sm text-gray-700 mt-3 leading-relaxed">
                        Informatics Report – 2 days left <br>
                        Social Studies Presentation – 3 days left <br>
                        Math Quiz – 1 day left
                    </p>
                    <button class="mt-4 bg-[#1B2A4E] text-white px-4 py-1 rounded-lg">
                        View Task
                    </button>
                </div>

            </div>
        </section>

        <!-- TODAY CLASSES -->
        <section class="px-10 mt-16">
            <div class="bg-white shadow-lg rounded-2xl py-10">

                <h2 class="text-center text-2xl font-semibold mb-8">Today’s Classes</h2>

                <div class="flex gap-6 overflow-x-auto px-6 pb-4">

                    <!-- CARD 1 -->
                    <div class="min-w-[180px] bg-[#8DB9D6] rounded-2xl p-6 text-center text-white">
                        <h3 class="text-lg font-semibold">Mathematics</h3>
                        <p class="mt-1">7.00 am</p>
                        <div class="mt-4 bg-white text-[#1B2A4E] px-3 py-1 rounded-full text-sm">
                            Mr. Bambang
                        </div>
                    </div>

                    <!-- CARD 2 -->
                    <div class="min-w-[180px] bg-[#8DB9D6] rounded-2xl p-6 text-center text-white">
                        <h3 class="text-lg font-semibold">English</h3>
                        <p class="mt-1">9.00 am</p>
                        <div class="mt-4 bg-white text-[#1B2A4E] px-3 py-1 rounded-full text-sm">
                            Mr. Aji
                        </div>
                    </div>

                    <!-- CARD 3 -->
                    <div class="min-w-[180px] bg-[#8DB9D6] rounded-2xl p-6 text-center text-white">
                        <h3 class="text-lg font-semibold">Informatics</h3>
                        <p class="mt-1">11.00 am</p>
                        <div class="mt-4 bg-white text-[#1B2A4E] px-3 py-1 rounded-full text-sm">
                            Mrs. Dian
                        </div>
                    </div>

                    <!-- CARD 4 -->
                    <div class="min-w-[180px] bg-[#8DB9D6] rounded-2xl p-6 text-center text-white">
                        <h3 class="text-lg font-semibold">Physics</h3>
                        <p class="mt-1">1.00 pm</p>
                        <div class="mt-4 bg-white text-[#1B2A4E] px-3 py-1 rounded-full text-sm">
                            Mrs. Lina
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- FOOTER (LIKE THE PICTURE) -->
        <footer class="bg-[#E4E4E4] py-10 text-center">

            <!-- TITLE "School" -->
            <h3 class="text-2xl font-semibold mb-3">
                <span class="text-[#132442]">School</span>
                <span class="text-[#2CB4DE]">Reminder</span>
            </h3>

            <!-- MENU -->
            <div class="flex justify-center gap-6 mt-3 text-sm font-medium text-[#132442]">
                <a href="#" class="hover:underline">About</a>
                <a href="#" class="hover:underline">Contact</a>
                <a href="#" class="hover:underline">Terms Of Service</a>
                <a href="#" class="hover:underline">Privacy Policy</a>
            </div>

            <!-- SOCIAL ICONS -->
            <div class="flex justify-center gap-4 mt-6">
                <img src="{{ asset('images/X-logo.png') }}" alt="X" class="w-6">
                <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="w-6">
                <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="w-6">
            </div>
            <!-- COPYRIGHT -->
            <p class="text-[#132442] text-sm mt-6">
                All Rights Reserved
            </p>
        </footer>

        <script>
            const splash = document.getElementById('splash');
            const main = document.getElementById('main');

            setTimeout(() => {
                splash.classList.add('hidden');
                main.classList.remove('hidden');
            }, 2500);
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const username = localStorage.getItem('sr_user');
                if (username) {
                    const el = document.getElementById('sr-username');
                    if (el) {
                        el.textContent = `Welcome, ${username}`;
                        el.classList.remove('hidden');
                    }
                }
            });
        </script>

</body>

</html>