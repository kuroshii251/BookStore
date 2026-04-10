@extends('layouts.navbar')
@section('contents')


<div class="flex items-center justify-center min-h-screen bg-gray-50">
  <div class="text-center max-w-2xl px-6">
    <h1 class="text-7xl font-bold text-black mb-4">
      Buy Your Future Books
    </h1>
    <p class="text-gray-600 text-lg mt-3">
      Temukan buku terbaik untuk masa depanmu

    </p>
<div class="flex space-x-5 items-center justify-center mt-10">
<a href="" class="text-xl bg-black rounded-full w-50 text-white font-semibold p-4">Get Started</a>
<a href="" class="text-xl border border-black w-50 rounded-full text-black font-semibold p-4">Read More</a>

</div>
  </div>
</div>

<section class="py-16 px-6 md:px-16 bg-gray-50">
  <div class="max-w-6xl mx-auto">

    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-10 text-center">
      About Us
    </h1>

    <div class="grid md:grid-cols-2 gap-10 items-center">

      <!-- Text Content -->
      <div class="space-y-5 text-gray-600 leading-relaxed">
        <p>
          <span class="font-semibold text-gray-800">BookPedia</span> adalah toko buku yang menyediakan berbagai pilihan buku berkualitas untuk memenuhi kebutuhan membaca semua kalangan. Mulai dari novel, buku pelajaran, buku pengembangan diri, hingga buku anak-anak.
        </p>

        <p>
          Kami berkomitmen untuk memberikan pengalaman berbelanja yang mudah, nyaman, dan terpercaya, baik secara offline maupun online. Dengan pelayanan yang ramah dan proses pembelian yang praktis, BookPedia menjadi tempat terbaik untuk menemukan buku favorit Anda.
        </p>

        <p>
          Kami percaya bahwa buku adalah jendela dunia. Oleh karena itu, kami hadir untuk membantu setiap orang mendapatkan akses terhadap ilmu pengetahuan, hiburan, dan inspirasi.
        </p>

        <p class="font-medium text-gray-700">
          Misi kami adalah menjadi toko buku pilihan utama dengan menyediakan produk berkualitas, harga terjangkau, dan layanan terbaik bagi pelanggan.
        </p>
      </div>

      <!-- Image / Illustration -->
      <div class="flex justify-center">
        <img
          src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f"
          alt="Book Store"
          class="rounded-2xl shadow-lg w-full max-w-md object-cover"
        />
      </div>

    </div>
  </div>
</section>

<div class="max-w-6xl mx-auto px-6 py-10">
  <div class="text-center">
    <h1 class="font-bold text-4xl md:text-5xl text-gray-800">
      Our Books
    </h1>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-10">

    <div class="bg-white border border-gray-200 rounded-4xl shadow-md hover:shadow-lg  transition duration-300 p-4">
      <img src="komet.jpg" class="rounded-lg p-7 h-110 object-cover" alt="Book Cover">

      <div class="px-5">
 <h2 class="text-lg font-semibold text-gray-600">
          Tere Liye
        </h2>
        <h2 class="text-lg font-semibold text-gray-800">
          Komet
        </h2>
        <p class="text-2xl mt-3 mb-5 text-gray-800 font-bold ">
Rp. 98.100
        </p>
      </div>
    </div>

  <div class="bg-white border border-gray-200 rounded-4xl shadow-md hover:shadow-lg  transition duration-300 p-4">
      <img src="sendiri.jpg" class="rounded-lg p-7 object-cover" alt="Book Cover">

      <div class="px-5">
 <h2 class="text-lg font-semibold text-gray-600">
          Tere Liye
        </h2>
        <h2 class="text-lg font-semibold text-gray-800">
          Sendiri
        </h2>
        <p class="text-2xl mt-3 mb-5 text-gray-800 font-bold ">
Rp. 98.100
        </p>
      </div>
    </div>

      <div class="bg-white border border-gray-200 rounded-4xl shadow-md hover:shadow-lg  transition duration-300 p-4">
      <img src="bintang.jpg" class="rounded-lg p-7 h-105 object-cover" alt="Book Cover">

      <div class="px-5">
 <h2 class="text-lg font-semibold text-gray-600">
          Tere Liye
        </h2>
        <h2 class="text-lg font-semibold text-gray-800">
          Bintang
        </h2>
        <p class="text-2xl mt-3 mb-5 text-gray-800 font-bold ">
Rp. 98.100
        </p>
      </div>
    </div>

      <div class="bg-white border border-gray-200 rounded-4xl shadow-md hover:shadow-lg  transition duration-300 p-4">
      <img src="pergi.png" class="rounded-lg p-7 object-cover" alt="Book Cover">

      <div class="px-5">
 <h2 class="text-lg font-semibold text-gray-600">
          Tere Liye
        </h2>
        <h2 class="text-lg font-semibold text-gray-800">
          Pergi
        </h2>
        <p class="text-2xl mt-3 mb-5 text-gray-800 font-bold ">
Rp. 98.100
        </p>
      </div>
    </div>

      <div class="bg-white border border-gray-200 rounded-4xl shadow-md hover:shadow-lg  transition duration-300 p-4">
      <img src="cantikituluka.jpg" class="rounded-lg p-7 object-cover" alt="Book Cover">

      <div class="px-5">
 <h2 class="text-lg font-semibold text-gray-600">
        Eka Kurniawan
        </h2>
        <h2 class="text-lg font-semibold text-gray-800">
          Cantik itu luka
        </h2>
        <p class="text-2xl mt-3 mb-5 text-gray-800 font-bold ">
Rp. 75.200
        </p>
      </div>
    </div>

     <div class="bg-white border border-gray-200 rounded-4xl shadow-md hover:shadow-lg  transition duration-300 p-4">
      <img src="hujan.jpg" class="rounded-lg p-7 object-cover" alt="Book Cover">

      <div class="px-5">
 <h2 class="text-lg font-semibold text-gray-600">
        Tere Liye
        </h2>
        <h2 class="text-lg font-semibold text-gray-800">
          Hujan
        </h2>
        <p class="text-2xl mt-3 mb-5 text-gray-800 font-bold ">
Rp. 92.000
        </p>
      </div>
    </div>




  </div>
</div>
<div class="flex items-center justify-center min-h-screen bg-gray-50">
  <div class="text-center max-w-2xl px-6">
    <h1 class="text-5xl font-bold text-black mb-4">
      Any Question?
    </h1>
    <p class="text-gray-600 text-lg mt-3">
        Contact Us

    </p>
<div class="flex space-x-5 items-center justify-center mt-10">


    <div class="bg-white">
        <form action="">
            <input type="text" placeholder="Enter your question...">
        </form>
    </div>

    <div class="bg-white">
<a href="" class="text-xl bg-black rounded-full w-50 text-white font-semibold p-4">Get Started</a>

    </div>

</div>
  </div>
</div>

</div>

</div>




@endsection
