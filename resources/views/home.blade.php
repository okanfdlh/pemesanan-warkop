<x-layout>
<!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden coffee-pattern">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <div class="hero-gradient absolute inset-0 z-10"></div>
            <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                 alt="Coffee Background" class="w-full h-full object-cover">
        </div>
        
        <!-- Hero Content -->
        <div class="relative z-20 text-center text-white px-6 max-w-4xl mx-auto">
            <div class="fade-in-up" style="animation-delay: 0.2s;">
                <h1 class="font-playfair text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    Rumah <span class="text-green-400">Seduh</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-200 font-light">
                    Kenyamanan Dalam Setiap Seduhan
                </p>
            </div>
            
            <div class="fade-in-up" style="animation-delay: 0.4s;">
                <p class="text-lg mb-12 text-gray-300 max-w-2xl mx-auto leading-relaxed">
                    Nikmati pengalaman kopi terbaik dengan suasana yang nyaman dan pelayanan yang ramah. 
                    Setiap cangkir adalah cerita, setiap tegukan adalah kenangan.
                </p>
            </div>
            
           <div class="fade-in-up flex flex-col sm:flex-row gap-4 justify-center items-center" style="animation-delay: 0.6s;">
                <!-- Tombol Jelajahi Menu -->
                <a 
                    href="#Menu"
                    @click.prevent="document.getElementById('Menu').scrollIntoView({ behavior: 'smooth' })"
                    class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all transform hover:scale-105 shadow-xl inline-block text-center"
                >
                    Jelajahi Menu
                </a>

                <!-- Tombol Tentang Kami -->
                <a 
                    href="#about"
                    @click.prevent="document.getElementById('about').scrollIntoView({ behavior: 'smooth' })"
                    class="glass-effect border border-white/30 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all transform hover:scale-105 hover:bg-white/20 inline-block text-center"
                >
                    Tentang Kami
                </a>
            </div>

            
            <!-- Floating Coffee Icons -->
            <div class="absolute top-1/4 left-1/4 floating-animation opacity-20" style="animation-delay: 0s;">
                <span class="text-6xl">☕</span>
            </div>
            <div class="absolute top-1/3 right-1/4 floating-animation opacity-20" style="animation-delay: 2s;">
                <span class="text-4xl">🫘</span>
            </div>
            <div class="absolute bottom-1/3 left-1/3 floating-animation opacity-20" style="animation-delay: 4s;">
                <span class="text-5xl">🥐</span>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20">
            <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-bounce"></div>
            </div>
        </div>
    </section>

<section id="Menu" class="bg-white pt-20 pb-8" x-data="{ 
    selectedCategory: localStorage.getItem('selectedCategory') || 'all' 
}" 
x-init="
    window.addEventListener('cart-updated', event => { 
        cartCount = event.detail.count; 
    });">
    <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    Menu <span class="text-green-600">Istimewa</span>
                </h2>
                <div class="w-24 h-1 bg-green-600 mx-auto mb-6"></div>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Koleksi minuman dan makanan pilihan yang disiapkan dengan penuh cinta dan keahlian
                </p>
            </div>  

<div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
     <!-- Menu Filter -->
            <div x-data="{ selectedCategory: 'all' }" class="max-w-4xl mx-auto">
    
            <!-- Filter Dropdown (Mobile Only) -->
            <div class="block md:hidden mb-6 px-4">
                <div class="relative">
                    <select 
                        x-model="selectedCategory"
                        class="block w-full appearance-none bg-white border border-gray-200 rounded-full py-3 pl-5 pr-10 text-gray-800 text-base font-medium shadow-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 ease-in-out"
                    >
                        <option value="all">📋 Semua Menu</option>
                        <option value="coffee">☕ Coffee</option>
                        <option value="non_coffee">🥤 Non Coffee</option>
                        <option value="makanan">🍽️ Makanan</option>
                        <option value="cemilan">🍩 Cemilan</option>
                    </select>
                    <!-- Dropdown Icon -->
                    <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>


            <!-- Filter Buttons (Desktop Only) -->
            <div class="hidden md:flex flex-wrap justify-center gap-4 mb-12">
                <button @click="selectedCategory = 'all'" 
                        :class="selectedCategory === 'all' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-green-100'"
                        class="px-6 py-3 rounded-full font-medium transition-all transform hover:scale-105">
                    📋 Semua Menu
                </button>
                <button @click="selectedCategory = 'coffee'" 
                        :class="selectedCategory === 'coffee' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-green-100'"
                        class="px-6 py-3 rounded-full font-medium transition-all transform hover:scale-105">
                    ☕ Coffee
                </button>
                <button @click="selectedCategory = 'non_coffee'" 
                        :class="selectedCategory === 'non_coffee' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-green-100'"
                        class="px-6 py-3 rounded-full font-medium transition-all transform hover:scale-105">
                    🥤 Non Coffee
                </button>
                <button @click="selectedCategory = 'makanan'" 
                        :class="selectedCategory === 'makanan' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-green-100'"
                        class="px-6 py-3 rounded-full font-medium transition-all transform hover:scale-105">
                    🍽️ Makanan
                </button>
                <button @click="selectedCategory = 'cemilan'" 
                        :class="selectedCategory === 'cemilan' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-green-100'"
                        class="px-6 py-3 rounded-full font-medium transition-all transform hover:scale-105">
                    🍩 Cemilan
                </button>
            </div>
        


    <div class="flex flex-col gap-8">
        @php
            $categories = ['coffee' => 'Coffee', 'non_coffee' => 'Non Coffee', 'makanan' => 'Makanan', 'cemilan' => 'Cemilan'];
        @endphp
        @foreach($categories as $key => $categoryName)
            <div id="{{ $key }}" x-show="selectedCategory === 'all' || selectedCategory === '{{ $key }}'" 
                 class="w-full p-4 sm:p-6">
                <div class="pb-6 font-bold text-2xl sm:text-3xl text-center text-gray-800">
                    <h3>{{ $categoryName }}</h3>
                    <div class="w-24 h-1 mx-auto bg-green-500 rounded-full mt-2"></div>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center">
                    @foreach($products->where('category', $key) as $product)
                    <div class="product-item bg-white p-4 border rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300"
                    id="product-{{ $product->id }}"  
                    data-name="{{ strtolower($product->name) }}">
                    <img class="w-full h-40 sm:h-48 object-cover rounded-lg" src="{{ asset('storage/' . $product->image) }}">
                    <div class="pt-3 text-center">
                        <p class="font-semibold text-lg text-gray-800">{{ $product->name }}</p>
                        <p class="text-green-600 font-bold">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                    </div>

                    <div class="flex items-center justify-center mt-3">
                        <button onclick="decreaseQuantity({{ $product->id }})" 
                                class="px-3 py-1 bg-gray-300 text-gray-700 rounded-l-lg hover:bg-gray-400">−</button>
                        <span id="quantity-{{ $product->id }}" 
                            class="px-4 py-1 bg-white border border-gray-300 text-gray-800 font-semibold">1</span>
                        <button onclick="increaseQuantity({{ $product->id }})" 
                                class="px-3 py-1 bg-gray-300 text-gray-700 rounded-r-lg hover:bg-gray-400">+</button>
                    </div>

                    <button 
                        onclick="addToCart({{ $product->id }})" 
                        class="mt-3 w-full bg-green-500 text-white font-semibold py-2 rounded-lg hover:bg-green-600 transition-all">
                        Pesan
                    </button>
                </div>

                     @endforeach

                </div>
            </div>
        @endforeach
    </div>
</div>
</section>

<section id="about" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    Tentang <span class="text-green-600">Kami</span>
                </h2>
                <div class="w-24 h-1 bg-green-600 mx-auto mb-6"></div>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Tempat di mana setiap cangkir bercerita dan setiap momen menjadi istimewa
                </p>
            </div>
            
            <!-- Story Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                <div>
                    <h3 class="font-playfair text-3xl font-bold text-gray-800 mb-6">
                        Cerita Kami
                    </h3>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                        Rumah Seduh lahir dari kecintaan pada kopi berkualitas dan keinginan untuk menciptakan 
                        ruang yang nyaman bagi komunitas. Sejak 2024, kami telah melayani banyak cangkir 
                        kebahagiaan dengan dedikasi tinggi.
                    </p>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        Setiap biji kopi dipilih dengan teliti, setiap resep dibuat dengan passion, 
                        dan setiap pelayanan diberikan dengan hati.
                    </p>
                    <div class="flex items-center space-x-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-600">500+</div>
                            <div class="text-gray-600">Pelanggan Puas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-600">30+</div>
                            <div class="text-gray-600">Menu Pilihan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-600">1</div>
                            <div class="text-gray-600">Tahun Pengalaman</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="swiper mySwiper rounded-3xl overflow-hidden shadow-2xl">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="{{ asset('img/rs1.jpg') }}" alt="Slide 1" class="w-full h-96 object-cover"></div>
                            <div class="swiper-slide"><img src="{{ asset('img/rs2.jpg') }}" alt="Slide 2" class="w-full h-96 object-cover"></div>
                            <div class="swiper-slide"><img src="{{ asset('img/rs3.jpg') }}" alt="Slide 3" class="w-full h-96 object-cover"></div>
                            <div class="swiper-slide"><img src="{{ asset('img/rs4.jpg') }}" alt="Slide 3" class="w-full h-96 object-cover"></div>
                        </div>
                        <!-- Tombol Navigasi -->
                        <div class="swiper-button-next custom-swiper-btn"></div>
                        <div class="swiper-button-prev custom-swiper-btn"></div>
                        <!-- Pagination (Optional) -->
                        <div class="swiper-pagination custom-pgt-btn"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    Kunjungi <span class="text-green-600">Kami</span>
                </h2>
                <div class="w-24 h-1 bg-green-600 mx-auto mb-6"></div>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Temukan kami di lokasi yang strategis dengan suasana yang nyaman
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Contact Info -->
                <div class="space-y-8">
                    <div class="bg-green-50 p-8 rounded-2xl">
                        <h3 class="font-playfair text-2xl font-bold text-gray-800 mb-6">Informasi Kontak</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-xl">📍</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Alamat</h4>
                                    <p class="text-gray-600">Jl.M. Safri Rachman,Sungailiat, Bangka</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-xl">🕐</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Jam Operasional</h4>
                                    <p class="text-gray-600">07.00 - 23.00 WIB</p>
                                    <p class="text-red-600 text-sm">Setiap hari Senin LIBUR</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Social Media</h4>
                                    <a href="https://www.instagram.com/rumahseduh20" 
                                       class="text-green-600 hover:text-green-700 transition-colors">
                                        @rumahseduh20
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <div class="text-center">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all transform hover:scale-105 inline-flex items-center space-x-2">
                            <span>📞</span>
                            <span>Hubungi Kami</span>
                        </button>
                    </div> --}}
                </div>
                <div class="relative">
                    <div class="bg-white p-4 rounded-2xl shadow-2xl">
                        <iframe class="w-full h-96 rounded-xl"  src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3987.6883167046867!2d106.12067807496682!3d-1.8722789981106345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwNTInMjAuMiJTIDEwNsKwMDcnMjMuNyJF!5e0!3m2!1sid!2sid!4v1740319026036!5m2!1sid!2sid" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                </section>
</x-layout>