<x-layout>

<div id="home" class="carousel relative container mx-auto pt-16" style="max-width:1600px;">
    <div class="carousel-inner relative overflow-hidden w-full">
        <!--Slide 1-->
        <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
        <div class="carousel-item absolute opacity-0" style="height:50vh;">
            <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right"
                style="background-image: url('https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">
                <div class="container mx-auto">
                    <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                        <p class="text-black text-2xl my-4">Stripy Zig Zag Jigsaw Pillow and Duvet Set</p>
                        <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-green-700 hover:border-green-700" href="#">view product</a>
                    </div>
                </div>
            </div>
        </div>
        <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-green-700 hover:text-white rounded-full bg-white hover:bg-green-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-green-700 hover:text-white rounded-full bg-white hover:bg-green-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

        <!--Slide 2-->
        <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
        <div class="carousel-item absolute opacity-0 bg-cover bg-right" style="height:50vh;">
            <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right"
                style="background-image: url('https://images.unsplash.com/photo-1533090161767-e6ffed986c88?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjM0MTM2fQ&auto=format&fit=crop&w=1600&q=80');">
                <div class="container mx-auto">
                    <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                        <p class="text-black text-2xl my-4">Real Bamboo Wall Clock</p>
                        <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-green-700 hover:border-green-700" href="#">view product</a>
                    </div>
                </div>
            </div>
        </div>
        <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-green-700 hover:text-white rounded-full bg-white hover:bg-green-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-green-700 hover:text-white rounded-full bg-white hover:bg-green-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

        <!--Slide 3-->
        <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
        <div class="carousel-item absolute opacity-0" style="height:50vh;">
            <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-bottom"
                style="background-image: url('https://images.unsplash.com/photo-1519327232521-1ea2c736d34d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">
                <div class="container mx-auto">
                    <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                        <p class="text-black text-2xl my-4">Brown and blue hardbound book</p>
                        <a class="text-xl inline-block no-underline border-b border-green-600 leading-relaxed hover:text-green-700 hover:border-green-700" href="#">view product</a>
                    </div>
                </div>
            </div>
        </div>
        <label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-green-700 hover:text-white rounded-full bg-white hover:bg-green-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        <label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-green-700 hover:text-white rounded-full bg-white hover:bg-green-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
<!-- Add automatic slide change -->
<script>
    let currentIndex = 1;
    setInterval(() => {
        document.getElementById(`carousel-${currentIndex}`).checked = true;
        currentIndex = currentIndex % 3 + 1;
    }, 3000);
</script>
</div>
</div>

<!--	 

Alternatively if you want to just have a single hero

<section class="w-full mx-auto bg-nordic-gray-light flex pt-12 md:pt-0 md:items-center bg-cover bg-right" style="max-width:1600px; height: 32rem; background-image: url('https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">

<div class="container mx-auto">

    <div class="flex flex-col w-full lg:w-1/2 justify-center items-start  px-6 tracking-wide">
        <h1 class="text-black text-2xl my-4">Stripy Zig Zag Jigsaw Pillow and Duvet Set</h1>
        <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">products</a>

    </div>

  </div>

</section>

-->

<section id="dMenu" class="bg-white pt-20 pb-8" x-data="{ 
    selectedCategory: localStorage.getItem('selectedCategory') || 'all' 
}" 
x-init="
    window.addEventListener('cart-updated', event => { 
        cartCount = event.detail.count; 
    });">

<div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

    <nav class="w-full flex justify-center">
        <div class="relative" x-data="{ openDropdown: false }">
            <button @click="openDropdown = !openDropdown"
                class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-5 py-2.5 rounded-lg shadow-lg transition">
                Daftar Menu
                <svg class="w-4 h-4 transition-transform duration-300" :class="openDropdown ? 'rotate-180' : 'rotate-0'"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <div x-show="openDropdown" @click.away="openDropdown = false"
                x-transition:enter="transition ease-out duration-200 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                
                <ul class="py-2 text-sm text-gray-800">
                    <li>
                        <button @click="selectedCategory = 'coffe'; openDropdown = false; setCategory('coffe')"
                            class="block px-4 py-2 hover:bg-green-100 w-full text-left">☕ Coffee</button>
                    </li>
                    <li>
                        <button @click="selectedCategory = 'nCoffe'; openDropdown = false; setCategory('nCoffe')"
                             class="block px-4 py-2 hover:bg-green-100 w-full text-left">🥤 Non Coffee</button>
                    </li>
                    <li>
                        <button @click="selectedCategory = 'makanan'; openDropdown = false; setCategory('makanan')"
                            class="block px-4 py-2 hover:bg-green-100 w-full text-left">🍽️ Makanan</button>
                    </li>
                    <li>
                        <button @click="selectedCategory = 'cemilan'; openDropdown = false; setCategory('cemilan')"
                            class="block px-4 py-2 hover:bg-green-100 w-full text-left">🍩 Cemilan</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- daftar --}}
    <div class="flex flex-col gap-8">
        <div class="flex flex-col gap-8">
            @php
        $categories = ['coffe' => 'Coffee', 'nCoffe' => 'Non Coffee', 'makanan' => 'Makanan', 'cemilan' => 'Cemilan'];
    @endphp
    @foreach($categories as $key => $categoryName)
        <div id="{{ $key }}" x-show="selectedCategory === '{{ $key }}' || selectedCategory === 'all'" class="w-full p-4 sm:p-6">
            <div class="pb-6 font-bold text-2xl sm:text-3xl text-center text-gray-800">
                <h3>{{ $categoryName }}</h3>
                <div class="w-24 h-1 mx-auto bg-green-500 rounded-full mt-2"></div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center">
                @foreach($products->where('category', $key) as $product)
                    <div class="bg-white p-4 border rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                        <img class="w-full h-40 sm:h-48 object-cover rounded-lg" src="{{ asset($product->image) }}">
                        <div class="pt-3 text-center">
                            <p class="font-semibold text-lg text-gray-800">{{ $product->name }}</p>
                            <p class="text-green-600 font-bold">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                        </div>

                        <!-- Tombol + - dan Jumlah -->
                        <div class="flex items-center justify-center mt-3">
                            <button onclick="decreaseQuantity({{ $product->id }})" 
                                    class="px-3 py-1 bg-gray-300 text-gray-700 rounded-l-lg hover:bg-gray-400">−</button>
                            <span id="quantity-{{ $product->id }}" 
                                  class="px-4 py-1 bg-white border border-gray-300 text-gray-800 font-semibold">1</span>
                            <button onclick="increaseQuantity({{ $product->id }})" 
                                    class="px-3 py-1 bg-gray-300 text-gray-700 rounded-r-lg hover:bg-gray-400">+</button>
                        </div>

                        <!-- Tombol Pesan -->
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

<section id="about" class="bg-white py-8">
    
    <div class="container py-8 px-6 mx-auto">
        <div class="pb-10">
        <a class=" pb-16 uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl mb-8" href="#">
        About
    </a>
    </div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="{{ asset('img/rs1.jpg') }}" alt="Slide 1"></div>
            <div class="swiper-slide"><img src="{{ asset('img/rs2.jpg') }}" alt="Slide 2"></div>
            <div class="swiper-slide"><img src="{{ asset('img/rs3.jpg') }}" alt="Slide 3"></div>
            <div class="swiper-slide"><img src="{{ asset('img/rs4.jpg') }}" alt="Slide 3"></div>
        </div>
        <!-- Tombol Navigasi -->
        <div class="swiper-button-next custom-swiper-btn"></div>
        <div class="swiper-button-prev custom-swiper-btn"></div>
        <!-- Pagination (Optional) -->
        <div class="swiper-pagination custom-pgt-btn"></div>
    </div>
    
        <p class="mt-8 mb-8">This template is inspired by the stunning nordic minimalist design - in particular:
            <br>
            <a class="text-gray-800 underline hover:text-gray-900" href="http://savoy.nordicmade.com/" target="_blank">Savoy Theme</a> created by <a class="text-gray-800 underline hover:text-gray-900" href="https://nordicmade.com/">https://nordicmade.com/</a> and <a class="text-gray-800 underline hover:text-gray-900" href="https://www.metricdesign.no/" target="_blank">https://www.metricdesign.no/</a></p>

        <p class="mb-8">Lorem ipsum dolor sit amet, consectetur <a href="#">random link</a> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vel risus commodo viverra maecenas accumsan lacus vel facilisis volutpat. Vitae aliquet nec ullamcorper sit. Nullam eget felis eget nunc lobortis mattis aliquam. In est ante in nibh mauris. Egestas congue quisque egestas diam in. Facilisi nullam vehicula ipsum a arcu. Nec nam aliquam sem et tortor consequat. Eget mi proin sed libero enim sed faucibus turpis in. Hac habitasse platea dictumst quisque. In aliquam sem fringilla ut. Gravida rutrum quisque non tellus orci ac auctor augue mauris. Accumsan lacus vel facilisis volutpat est velit egestas dui id. At tempor commodo ullamcorper a. Volutpat commodo sed egestas egestas fringilla. Vitae congue eu consequat ac.</p>

        
    </div>
    <div class="w-full flex justify-center items-center">
        <div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 relative rounded-lg overflow-hidden shadow-lg bg-white p-4">
            <div class="mb-3 font-extrabold text-xl text-center">
                <h3>Alamat</h3>
            </div>
            <iframe class="w-full h-[300px] md:h-[400px] lg:h-[500px] rounded-lg" 
                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3987.6883167046867!2d106.12067807496682!3d-1.8722789981106345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwNTInMjAuMiJTIDEwNsKwMDcnMjMuNyJF!5e0!3m2!1sid!2sid!4v1740319026036!5m2!1sid!2sid" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
    
    
</section>

</x-layout>