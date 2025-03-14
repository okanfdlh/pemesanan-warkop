<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Rumah Seduh</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="Free open source Tailwind CSS Store template">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,store template, shop layout, minimal, monochrome, minimalistic, theme, nordic">
    
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
	<!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        .work-sans {
            font-family: 'Work Sans', sans-serif;
        }
                
        #menu-toggle:checked + #menu {
            display: block;
        }
        
        .hover\:grow {
            transition: all 0.3s;
            transform: scale(1);
        }
        
        .hover\:grow:hover {
            transform: scale(1.02);
        }
        
        .carousel-open:checked + .carousel-item {
            position: static;
            opacity: 100;
        }
        
        .carousel-item {
            -webkit-transition: opacity 0.6s ease-out;
            transition: opacity 0.6s ease-out;
        }
        
        #carousel-1:checked ~ .control-1,
        #carousel-2:checked ~ .control-2,
        #carousel-3:checked ~ .control-3 {
            display: block;
        }
        
        .carousel-indicators {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            bottom: 2%;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }
        
        #carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
        #carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
        #carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
            color: #000;
            /*Set to match the Tailwind colour you want the active one to be */
        }
        .swiper {
        width: 100%;
        height: auto;
    }
    .swiper-slide img {
        width: 100%;
        height: auto;
        border-radius: 10px; /* Opsional: Membuat sudut gambar membulat */
    }
    .custom-swiper-btn {
        @apply bg-green-500 text-white p-3 rounded-full;
    }
    .custom-swiper-btn::after {
        color: rgb(49, 128, 3) !important; /* Warna icon panah */
        font-size: 35px !important;
    }
    .custom-swiper-btn:hover {
        @apply bg-green-700;
    }
    .swiper-pagination-bullet {
        background-color: #22c55e !important; /* Tailwind green-500 */
        opacity: 0.7 !important;
    }
    .swiper-pagination-bullet-active {
        background-color: #15803d !important; /* Tailwind green-700 */
        opacity: 1 !important;
    }
    </style>

</head>
<body class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">
    {{-- header --}}
        <!--Nav-->
        <header x-data="{ open: false }" class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
<x-navbar></x-navbar>
<main>{{ $slot }}</main>
<footer class="container mx-auto bg-white py-8 border-t border-gray-400">
    <div class="w-full flex justify-center items-center">
        
 
    <div class="container flex px-3 py-8 ">
    <div class="w-full mx-auto flex flex-wrap">
      <div class="flex w-full lg:w-1/2 ">
        <div class="px-3 md:px-0">
          <h3 class="font-bold text-gray-900">About</h3>
          <p class="py-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus commodo nec id erat. Suspendisse consectetur dapibus velit ut lacinia.
          </p>
        </div>
      </div>
      
      <div class="flex w-full lg:w-1/2 lg:justify-end lg:text-right mt-6 md:mt-0">
        <div class="px-3 md:px-0">
          <h3 class="text-left font-bold text-gray-900">Social</h3>
    
          <div class="w-full flex items-center py-4 mt-0">
            <a href="#" class="mx-2">
              <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"></path>
              </svg>
            </a>
            <a href="#" class="mx-2">
              <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
              </svg>
            </a>
            <a href="https://www.instagram.com/rumahseduh20" class="mx-2">
              <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"></path>
              </svg>
            </a>
            <a href="#" class="mx-2">
              <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    <div class="text-center mt-8">  
        <p class="text-gray-600">© 2025 - Indirokan Fadhilah</p>  
        <a href="https://instagram.com/okanfdlh" class="text-blue-600">instagram.com/okanfdlh</a> 
    </div>  
    </footer>
    <script>
        // tambah data
        function addToCart(productId) {
      let quantity = document.getElementById('quantity-' + productId).innerText;
  
      fetch("{{ route('cart.add') }}", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({
              product_id: productId,
              quantity: quantity
          })
      })
      .then(response => response.json())
      .then(data => {
          alert(data.message); // Notifikasi sukses
  
          // Refresh halaman setelah pesanan ditambahkan
          setTimeout(() => {
              window.location.reload();
          }, 500); // Delay 0.5 detik untuk pengalaman yang lebih smooth
      })
      .catch(error => console.error("Error:", error));
  }
  
  
      function increaseQuantity(productId) {
          let quantitySpan = document.getElementById('quantity-' + productId);
          quantitySpan.innerText = parseInt(quantitySpan.innerText) + 1;
      }
  
      function decreaseQuantity(productId) {
          let quantitySpan = document.getElementById('quantity-' + productId);
          if (parseInt(quantitySpan.innerText) > 1) {
              quantitySpan.innerText = parseInt(quantitySpan.innerText) - 1;
          }
      }
      document.addEventListener("DOMContentLoaded", function () {
        let lastCategory = localStorage.getItem('lastCategory');
        if (lastCategory) {
            document.querySelector("[x-data]").setAttribute("x-data", `{ selectedCategory: '${lastCategory}' }`);
        }
    });

// Simpan kategori saat user memilih
function setCategory(category) {
    localStorage.setItem("selectedCategory", category);
}

// swiper
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,  // Auto loop gambar
        autoplay: {
            delay: 3000,  // Slide otomatis setiap 3 detik
            disableOnInteraction: false, // Auto slide tetap berjalan setelah user interaksi
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        }
    });
    
    function updatePaymentStatus(orderId) {
    fetch(`/order/${orderId}/update-payment-status`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload(); // Refresh halaman setelah update status
        })
        .catch(error => console.error("Error:", error));
    }

    // pecarian
    function searchComponent() {
        return {
            showSearch: false,
            searchQuery: '',
            products: @json($products), // Mengirim data produk dari Laravel ke Alpine.js
            get filteredProducts() {
                if (this.searchQuery.trim() === '') {
                    return [];
                }
                return this.products.filter(product =>
                    product.name.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            }
        }
    }
    // smooth scrolling
    document.querySelectorAll('a[href^="{{ url("/") }}#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = this.href;
    });
});




    </script>
    
    </body>
    
    </html>