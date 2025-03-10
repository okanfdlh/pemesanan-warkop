<nav id="header" class="w-full z-30 top-0 py-1">
        
<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

    <label for="menu-toggle" class="cursor-pointer md:hidden block">
        <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
            <title>menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
        </svg>
    </label>
    <input class="hidden" type="checkbox" id="menu-toggle" />

    <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
        <nav>
            <ul class="md:flex items-center justify-between text-base text-gray-700 pt-4 md:pt-0">
                <li><a class="inline-block no-underline hover:text-green-800 hover:underline py-2 px-4" href="{{ url('/') }}#Home">Home</a></li>
                <li><a class="inline-block no-underline hover:text-green-800 hover:underline py-2 px-4" href="{{ url('/') }}#Menu">Menu</a></li>
                <li><a class="inline-block no-underline hover:text-green-800 hover:underline py-2 px-4" href="{{ url('/') }}#About">About</a></li>
            </ul>
        </nav>
    </div>

    <div class="order-1 md:order-2">
        <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="/">
            <img src="{{ asset('img/rslogo.jpg') }}" class="w-14">
            Rumah Seduh
        </a>
    </div>

    <div class="order-2 md:order-3 flex items-center gap-4" id="nav-content">
        <!-- Pencarian -->
        <div x-data="searchComponent()" class="relative">
            <!-- Ikon Pencarian -->
            <a @click="showSearch = !showSearch" class="cursor-pointer flex items-center">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-gray-700 fill-current hover:text-green-800 transition-transform"
                    :class="{ 'rotate-90': showSearch }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <circle fill="none" cx="12" cy="7" r="3" />
                    <path d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10
                        c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                </svg>
            </a>
    
            <!-- Input Pencarian -->
            <div x-show="showSearch" @click.away="showSearch = false"
                class="absolute right-0 top-full w-80 bg-white shadow-lg rounded-lg p-3 transition-all z-50 border border-gray-200">
                
                <div class="flex items-center border rounded-lg px-4 py-2 focus-within:ring focus-within:ring-green-300">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m2.85-6.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" x-model="searchQuery" placeholder="Cari menu..."
                        class="w-full border-none outline-none px-3 text-gray-700" />
                    <button @click="showSearch = false" class="text-gray-500 hover:text-gray-700">
                        ✕
                    </button>
                </div>
    
                <!-- Hasil Pencarian -->
                <div x-show="filteredProducts.length > 0"
                    class="mt-2 bg-white shadow-md rounded-lg max-h-60 overflow-auto border border-gray-200">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <a :href="'/#product-' + product.id"
                            class="block p-3 border-b last:border-none hover:bg-gray-100 transition flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800 text-sm" x-text="product.name"></p>
                                <p class="text-green-600 font-bold text-xs"
                                    x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(product.price)"></p>
                            </div>
                            <img :src="product.image" alt="Product Image" class="w-10 h-10 object-cover rounded-lg">
                        </a>
                    </template>
                    
                </div>
    
                <!-- Jika Tidak Ada Hasil -->
                <p x-show="filteredProducts.length === 0 && searchQuery.length > 0"
                    class="mt-2 bg-white shadow-md p-4 rounded-lg text-gray-500 border border-gray-200 text-center">
                    ❌ Produk tidak ditemukan.
                </p>
            </div>
        </div>
    
        <!-- Keranjang -->
        <a class="relative inline-block no-underline hover:text-green-800" href="/chart"
            x-data="{ cartCount: localStorage.getItem('cartCount') || {{ session('cart') ? count(session('cart')) : 0 }} }"
            x-init="
                window.addEventListener('cart-updated', event => { 
                    cartCount = event.detail.count;
                    localStorage.setItem('cartCount', cartCount); 
                });
            ">
    
            <svg class="fill-current hover:text-green-800 w-7 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 
                        c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z 
                        M17.341,14h-6.697L8.371,9 h11.112L17.341,14z" />
                <circle cx="10.5" cy="18.5" r="1.5" />
                <circle cx="17.5" cy="18.5" r="1.5" />
            </svg>
    
            <!-- Badge jumlah pesanan -->
            <span x-show="cartCount > 0" x-text="cartCount"
                class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full 
                    transform translate-x-1/2 -translate-y-1/2 shadow-md">
            </span>
        </a>
    </div>
    
</nav>
</header>