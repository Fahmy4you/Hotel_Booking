@extends('layouts/home')

@section('container')

<!-- ====== hero ====== -->

<section id="home" class="relative py-16 lg:pt-[100px] bg-white">
    <div class="mx-auto max-w-7xl px-8 md:px-6">
        <div class="flex flex-wrap items-center">
            <div class="w-full lg:w-5/12">
                <h1 class="text-slate-800 mb-3 text-4xl font-bold leading-snug sm:text-[42px] lg:text-[40px] xl:text-[42px]">Everything you need to your online <span class="text-blue-600">Hotel Luxury</span></h1>
                <p class="text-slate-500 mb-8 max-w-[480px] text-base">Welcome to<span class="text-blue-600"> MARBLE BLUE</span> a place where comfort, luxury, and excitement meet. We offer an unforgettable stay with elegant rooms, modern amenities and friendly service to meet all your needs, whether for leisure or business travel.
                </p>
                
                <a href="{{ route('list_room') }}" class="w-full rounded-md bg-blue-500 px-8 py-2.5 font-semibold text-white shadow-md shadow-blue-500/20 hover:bg-blue-600 duration-200 sm:w-auto">Booking Now</a>

                <a href="{{ route('login') }}" class="mt-4 box-border w-full rounded-md border border-blue-500/20 px-8 py-2.5 font-semibold text-blue-500 shadow-md shadow-blue-500/10 duration-200 sm:ml-4 sm:mt-0 sm:w-auto ">Get Started</a>

                <!-- brand -->
                <div class="mt-6 flex flex-wrap gap-4">
                    <img src="{{ asset('image/landing_page/brand/brand (1).png') }}" alt="brand" class="w-32 cursor-pointer rounded-lg border border-blue-300/20 bg-white px-5 py-3 shadow-md shadow-blue-500/5 duration-200 hover:scale-95 sm:w-36">
                    <img src="{{ asset('image/landing_page/brand/brand (2).png') }}" alt="brand" class="w-32 cursor-pointer rounded-lg border border-blue-300/20 bg-white px-5 py-3 shadow-md shadow-blue-500/5 duration-200 hover:scale-95 sm:w-36">
                    <img src="{{ asset('image/landing_page/brand/brand (3).png') }}" alt="brand" class="w-32 cursor-pointer rounded-lg border border-blue-300/20 bg-white px-5 py-3 shadow-md shadow-blue-500/5 duration-200 hover:scale-95 sm:w-36">
                    <img src="{{ asset('image/landing_page/brand/brand (4).png') }}" alt="brand" class="w-32 cursor-pointer rounded-lg border border-blue-300/20 bg-white px-5 py-3 shadow-md shadow-blue-500/5 duration-200 hover:scale-95 sm:w-36">
                </div>
            </div>

            <div class="hidden px-4 lg:block lg:w-1/12"></div>

            <div class="w-full px-4 lg:w-6/12 ">
                <div class="lg:ml-auto lg:text-right">
                    <div class="relative z-10 inline-block pt-11 lg:pt-0 ">
                        <img src="{{ asset('image/landing_page/hero.jpg') }}" alt="hero section img" class="w-[600px] h-[600px] lg:ml-auto rounded-md">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====== END hero ====== -->


<!-- ====== About ====== -->

<section id="about" class="pb-16">
    <div class="mx-auto max-w-7xl px-8 md:px-6">
        <!-- heading text -->
        <div class="mb-5 sm:mb-10">
            <span class="font-medium text-blue-500">About</span>
            <h1 class="text-2xl font-bold text-slate-700 sm:text-3xl">About Our Hotel</h1>
        </div>
        <!-- features img -->
        <div class="md:flex md:justify-between md:gap-6 xl:gap-10 items-center">
            <div class="mb-5 max-h-[600px] overflow-hidden rounded-lg md:mb-0 md:w-5/12">
                <img src="{{ asset('image/landing_page/about.jpg') }}" alt="features img" class="h-full scale-125 sm:w-full sm:object-cover">
            </div>
            <div class="md:w-7/12">
                <div class="mb-16 flex flex-col">
                    <p class="mb-3 text-slate-500">Enjoy a relaxing time at our bar which serves a wide selection of exclusive drinks and signature cocktails. With a warm atmosphere and indulgent music, our bar is the perfect place to relax after a long day or gather with friends.</p>

                    <p class="mb-10 text-slate-500">With its strategic location and alluring atmosphere, <span class="text-blue-600"> MARBLE BLUE</span> is the ideal destination to create precious moments. We look forward to your visit and are ready to provide the best service to ensure your experience is memorable.</p>

                    <button class="w-full rounded-md bg-blue-500 px-8 py-2.5 font-semibold text-white shadow-md shadow-blue-500/20 hover:bg-blue-600 duration-200 md:w-max">Show More</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====== END About ====== -->


<!-- ====== Galery ====== -->

<section id="galery" class="py-16">
    <div class="mx-auto max-w-7xl px-8 md:px-6">
        <!-- heading text -->
        <div class="mb-10 text-center">
            <span class="font-medium text-blue-500">Our Galery</span>
            <h1 class="text-2xl font-bold text-slate-700 sm:text-3xl">A Little Bit of Our Story</h1>
            <p class="mx-auto mt-2 text-slate-500">Various Kinds of Facilities From Our Hotel That You Can Enjoy</p>
        </div>
        <!-- wrapper -->
        <div class="flex flex-col gap-5">
            <!-- col-1 -->
            <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-4">
                <div class="group relative h-40 overflow-hidden rounded-lg lg:h-52">
                    <img src="{{ asset('image/landing_page/galery/p-1.jpg') }}" alt="portfolio img" class="absolute h-full w-full object-cover duration-200 group-hover:scale-125">
                    <div class="absolute -bottom-60 flex w-full cursor-pointer items-center justify-between bg-gradient-to-t from-slate-800 px-3 pb-4 pt-10 duration-200 group-hover:-bottom-0">
                        <p class="text-sm font-semibold text-white">Bar Hotel <span class="text-xs text-slate-300 block">20 January 2025</span></p>
        
                    </div>
                </div>
                <div class="group relative h-40 overflow-hidden rounded-lg lg:h-52">
                    <img src="{{ asset('image/landing_page/galery/p-2.jpg') }}" alt="portfolio img" class="absolute h-full w-full object-cover duration-200 group-hover:scale-125">
                    <div class="absolute -bottom-60 flex w-full cursor-pointer items-center justify-between bg-gradient-to-t from-slate-800 px-3 pb-4 pt-10 duration-200 group-hover:-bottom-0">
                        <p class="text-sm font-semibold text-white">Gym Place <span class="text-xs text-slate-300 block">20 January 2025</span></p>
        
                    </div>
                </div>
                <div class="group relative h-40 overflow-hidden rounded-lg lg:h-52 sm:col-span-2">
                    <img src="{{ asset('image/landing_page/galery/p-3.jpg') }}" alt="portfolio img" class="absolute h-full w-full object-cover duration-200 group-hover:scale-125">
                    <div class="absolute -bottom-60 flex w-full cursor-pointer items-center justify-between bg-gradient-to-t from-slate-800 px-3 pb-4 pt-10 duration-200 group-hover:-bottom-0">
                        <p class="text-sm font-semibold text-white">City Light in The Room <span class="text-xs text-slate-300 block">20 January 2025</span></p>
        
                    </div>
                </div>
            </div>
            <!-- end col-1 -->

            <!-- col-2 -->
            <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3">
                <div class="group relative h-40 overflow-hidden rounded-lg lg:h-52 md:col-span-2">
                    <img src="{{ asset('image/landing_page/galery/p-4.jpg') }}" alt="portfolio img" class="absolute h-full w-full object-cover duration-200 group-hover:scale-125">
                    <div class="absolute -bottom-60 flex w-full cursor-pointer items-center justify-between bg-gradient-to-t from-slate-800 px-3 pb-4 pt-10 duration-200 group-hover:-bottom-0">
                        <p class="text-sm font-semibold text-white">An Eye Catching View of The Sea <span class="text-xs text-slate-300 block">20 January 2025</span></p>
        
                    </div>
                </div>
                <div class="group relative h-40 overflow-hidden rounded-lg lg:h-52">
                    <img src="{{ asset('image/landing_page/galery/p-5.jpg') }}" alt="portfolio img" class="absolute h-full w-full object-cover duration-200 group-hover:scale-125">
                    <div class="absolute -bottom-60 flex w-full cursor-pointer items-center justify-between bg-gradient-to-t from-slate-800 px-3 pb-4 pt-10 duration-200 group-hover:-bottom-0">
                        <p class="text-sm font-semibold text-white">Sunset From the Rooftop <span class="text-xs text-slate-300 block">20 January 2025</span></p>
        
                    </div>
                </div>
            </div>
            <!-- end col-2 -->

            <!-- col-3 -->
            <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-4">
                <div class="group relative h-40 overflow-hidden rounded-lg lg:h-52">
                    <img src="{{ asset('image/landing_page/galery/p-6.jpg') }}" alt="portfolio img" class="absolute h-full w-full object-cover duration-200 group-hover:scale-125">
                    <div class="absolute -bottom-60 flex w-full cursor-pointer items-center justify-between bg-gradient-to-t from-slate-800 px-3 pb-4 pt-10 duration-200 group-hover:-bottom-0">
                        <p class="text-sm font-semibold text-white">Indoor Swimming Pool <span class="text-xs text-slate-300 block">20 January 2025</span></p>
        
                    </div>
                </div>
                <div class="group relative h-40 overflow-hidden rounded-lg lg:h-52">
                    <img src="{{ asset('image/landing_page/galery/p-7.jpg') }}" alt="portfolio img" class="absolute h-full w-full object-cover duration-200 group-hover:scale-125">
                    <div class="absolute -bottom-60 flex w-full cursor-pointer items-center justify-between bg-gradient-to-t from-slate-800 px-3 pb-4 pt-10 duration-200 group-hover:-bottom-0">
                        <p class="text-sm font-semibold text-white">Luxury Hotel Hallway <span class="text-xs text-slate-300 block">20 January 2025</span></p>
        
                    </div>
                </div>
                <div class="group relative h-40 overflow-hidden rounded-lg lg:h-52 sm:col-span-2">
                    <img src="{{ asset('image/landing_page/galery/p-8.jpg') }}" alt="portfolio img" class="absolute h-full w-full object-cover duration-200 group-hover:scale-125">
                    <div class="absolute -bottom-60 flex w-full cursor-pointer items-center justify-between bg-gradient-to-t from-slate-800 px-3 pb-4 pt-10 duration-200 group-hover:-bottom-0">
                        <p class="text-sm font-semibold text-white">Luxury Cafe with Five-Star Chef <span class="text-xs text-slate-300 block">20 January 2025</span></p>
        
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
        </div>
    </div>
</section>
<!-- ====== END Galery ====== -->


<!-- ====== ROOM'S ====== -->

<section id="room" class="py-16">
    <div class="mx-auto max-w-7xl px-8 md:px-6">
        <!-- heading text -->
        <div class="mb-5 sm:mb-10 flex items-center justify-between">
            <div class="">
                <span class="font-medium text-blue-500">Our Best Room's</span>
                <h1 class="text-2xl font-bold text-slate-700 sm:text-3xl">The best rooms in our hotel</h1>
            </div>
            <div class="">
                <a href="{{ route('list_room') }}" class="mr-10 hidden rounded-md bg-blue-500 px-6 py-1.5 font-semibold text-white shadow-md shadow-blue-500/20 duration-200 hover:bg-blue-600 sm:block lg:mr-0">View More</a>
            </div>
        </div>
        <!-- wrapper -->
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:gap-10">
            @foreach ($rooms as $room)
                <div class="max-w-sm mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Gambar -->
                    <img
                    class="w-full h-48 object-cover"
                    src="{{ asset('storage/image/kamar/'.$room->image) }}"
                    alt="Deskripsi Gambar"
                    />
                
                    <!-- Konten -->
                    <div class="p-4">
                    <!-- Judul -->
                    <h2 class="text-lg font-bold text-gray-800">{{ $room->room }}</h2>
                
                    <!-- Kategori -->
                    <p class="text-sm text-gray-500 mt-1">{{ $room->category->name }}</p>
                
                    <!-- Harga -->
                    <p class="text-xl font-semibold text-green-500 mt-2">Rp {{ number_format($room->price, 0, ',', '.') }}</p>
                
                    <!-- Tombol Booking -->
                    <a href="{{ route('bookings.edit', $room->id) }}" class="flex justify-center mt-4 w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                        Booking Now
                    </a>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</section>

<!-- ====== END Room's ====== -->


<!-- ====== Contact ====== -->

<section id="contact" class="relative overflow-hidden py-16">
    <img src="{{ asset('image/landing_page/effect.png') }}" alt="effect" class="absolute bottom-[-400px] -z-10 w-full opacity-[0.2]">
    <div class="mx-auto max-w-7xl px-8 md:px-6">
        <div class="-mx-4 flex flex-wrap lg:justify-between">

            <!-- left info-->
            <div class="w-full px-4 md:w-1/2 xl:w-6/12">
                <div class="mb-12 max-w-[570px] lg:mb-0">
                    <span class="font-medium text-blue-500">Contact Us</span>
                    <h1 class="mb-3 text-2xl font-bold text-slate-700 sm:text-3xl">GET IN TOUCH WITH US</h1>
                    <p class="text-slate-500 mb-8">You can ask anything about us through the contact</p>
                    
                    
                    <!-- address -->
                    <div class="mb-8 flex w-full max-w-[420px] items-center rounded-lg bg-white p-4 shadow-md shadow-blue-500/10">
                        <div class="mr-6 flex h-[60px] w-full max-w-[60px] items-center justify-center overflow-hidden rounded bg-blue-500 bg-opacity-5 text-blue-500 sm:h-[70px] sm:max-w-[70px]">
                            <ion-icon name="location-outline" class="text-3xl"></ion-icon>
                        </div>
                        <div class="w-full">
                            <h4 class="mb-1 text-xl font-bold text-slate-700">Our Location</h4>
                            <p class="text-base text-slate-400
                            ">Perum GPA, Karang Ploso, Malang, Jawa Timur, Indonesia</p>
                        </div>
                    </div>
                    <!-- phone -->
                    <div class="mb-8 flex w-full max-w-[420px] items-center rounded-lg bg-white p-4 shadow-md shadow-blue-500/10">
                        <div class="mr-6 flex h-[60px] w-full max-w-[60px] items-center justify-center overflow-hidden rounded bg-blue-500 bg-opacity-5 text-blue-500 sm:h-[70px] sm:max-w-[70px]">
                            <ion-icon name="call-outline" class="text-3xl"></ion-icon>
                        </div>
                        <div class="w-full">
                            <h4 class="mb-1 text-xl font-bold text-slate-700">Phone Number</h4>
                            <p class="text-base text-slate-400
                            ">(+62)86 2345 6789</p>
                        </div>
                    </div>
                    <!-- mail -->
                    <div class="mb-8 flex w-full max-w-[420px] items-center rounded-lg bg-white p-4 shadow-md shadow-blue-500/10">
                        <div class="mr-6 flex h-[60px] w-full max-w-[60px] items-center justify-center overflow-hidden rounded bg-blue-500 bg-opacity-5 text-blue-500 sm:h-[70px] sm:max-w-[70px]">
                            <ion-icon name="mail-outline" class="text-3xl"></ion-icon>
                        </div>
                        <div class="w-full">
                            <h4 class="mb-1 text-xl font-bold text-slate-700">Email Address</h4>
                            <p class="text-base text-slate-400
                            ">marbleblue2025@gmail.com</p>
                        </div>
                    </div>


                </div>
            </div>

            <!-- right contact-->
            <div class="w-full px-4 md:w-1/2 xl:w-5/12">
                <div class="relative rounded-lg bg-white p-8 shadow-lg shadow-blue-500/10 sm:p-12">
                    <form action="">
                        <div class="mb-6">
                            <input type="text" placeholder="Your Name" class="w-full rounded-lg border border-blue-500/20 px-4 py-3 text-slate-500 focus:border-blue-500 focus:outline-none">
                        </div>
                        <div class="mb-6">
                            <input type="email" placeholder="Your Email" class="w-full rounded-lg border border-blue-500/20 px-4 py-3 text-slate-500 focus:border-blue-500 focus:outline-none">
                        </div>
                        <div class="mb-6">
                            <input type="password" placeholder="Your Passsword" class="w-full rounded-lg border border-blue-500/20 px-4 py-3 text-slate-500 focus:border-blue-500 focus:outline-none">
                        </div>
                        <div class="mb-6">
                            <textarea name="message" rows="6" class="resize-none w-full rounded-lg border border-blue-500/20 px-4 py-3 text-slate-500 focus:border-blue-500 focus:outline-none"></textarea>
                        </div>
                        <div class="">
                            <button type="submit" class="w-full rounded border border-blue-300 bg-blue-500 p-3 text-white transition-all hover:bg-opacity-90">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</section>

<!-- ====== END Contact ====== -->

@endsection