<x-front-layout>
    <section class="container my-16 px-4">
        <div class="text-center mb-10" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Catalog Mobil</h2>
            <p class="text-gray-600 mt-3">Pilih mobil berdasarkan brand yang kamu suka!</p>
        </div>

        <!-- Filter Brand -->
        <div class="flex justify-center gap-3 flex-wrap mb-10" data-aos="fade-up" data-aos-delay="100">
            <button class="bg-[#4743FB] text-white px-5 py-2 rounded-full transition filter-btn active"
                data-brand="all">
                Semua Brand
            </button>
            @foreach($brands as $brand)
                <button class="bg-gray-200 hover:bg-[#4743FB] hover:text-white transition px-5 py-2 rounded-full filter-btn"
                    data-brand="{{ $brand->name }}">
                    {{ $brand->name }}
                </button>
            @endforeach
        </div>

        <!-- List Mobil -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="car-list" data-aos="fade-up" data-aos-delay="200">
            @forelse($items as $item)
                <div class="car-item bg-white shadow-md rounded-2xl p-6 relative border transition hover:shadow-xl hover:border-[#4743FB] duration-300"
                    data-brand="{{ $item->brand->name ?? 'Tanpa Brand' }}">
                    <div class="mb-4">
                        <img src="{{ $item->thumbnail }}" class="rounded-xl w-full h-[160px] object-cover mb-4" alt="">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">{{ $item->name }}</h4>
                                <p class="text-gray-500 text-sm">Rp {{ $item->price }}/day</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-1"><i class="fas fa-car"></i> {{ $item->transmission ?? 'Manual' }}</div>
                        <div class="flex items-center gap-1"><i class="fas fa-user-friends"></i> {{ $item->seats ?? '4' }} Seats</div>
                        <div class="flex items-center gap-1"><i class="fas fa-gas-pump"></i> {{ $item->mpg ?? '30' }} MPG</div>
                    </div>
                    <a href="{{ route('front.detail', $item->slug) }}"
                        class="bg-[#4743FB] hover:bg-[#3a37d0] text-white block text-center py-2 w-full rounded-md font-medium transition">
                        Rent Now
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">Tidak ada mobil tersedia.</div>
            @endforelse
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.filter-btn');
            const cars = document.querySelectorAll('.car-item');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Remove active class from all
                    buttons.forEach(b => b.classList.remove('bg-[#4743FB]', 'text-white', 'active'));
                    buttons.forEach(b => b.classList.add('bg-gray-200'));

                    // Add active to current
                    btn.classList.remove('bg-gray-200');
                    btn.classList.add('bg-[#4743FB]', 'text-white', 'active');

                    const brand = btn.getAttribute('data-brand');
                    let visible = 0;

                    cars.forEach(car => {
                        if (brand === 'all' || car.getAttribute('data-brand') === brand) {
                            car.style.display = 'block';
                            visible++;
                        } else {
                            car.style.display = 'none';
                        }
                    });

                    // Optional: if no cars visible, show a message
                    if (visible === 0) {
                        document.getElementById('car-list').innerHTML = `
                            <div class="col-span-3 text-center text-gray-500 w-full">Mobil tidak ditemukan untuk brand tersebut.</div>
                        `;
                    }
                });
            });
        });
    </script>
</x-front-layout>
