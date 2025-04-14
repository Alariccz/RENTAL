<x-front-layout>
    <section class="container my-16">
        <div class="text-center mb-10" data-aos="fade-up">
            <h2 class="text-3xl font-bold">Catalog Mobil</h2>
            <p class="text-gray-600 mt-2">Pilih mobil berdasarkan brand yang kamu suka!</p>
        </div>

        <!-- Filter Brand -->
        <div class="flex justify-center gap-4 flex-wrap mb-10" data-aos="fade-up" data-aos-delay="100">
            @foreach($brands as $brand)
                <button class="bg-gray-200 hover:bg-[#4743FB] hover:text-white transition px-6 py-2 rounded-full filter-btn"
                    data-brand="{{ $brand->name }}">
                    {{ $brand->name }}
                </button>
            @endforeach
        </div>

        <!-- List Mobil -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="car-list" data-aos="fade-up"
            data-aos-delay="200">
            @foreach($items as $item)
                <div class="car-item bg-white shadow-md rounded-2xl p-6 relative border transition hover:shadow-lg {{ $item->name === 'Honda Jazz RS' ? 'border-[#4743FB]' : '' }}"
                    data-brand="{{ $item->brand->name ?? 'Tanpa Brand' }}">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-lg font-semibold">{{ $item->name }}</h4>
                            <p class="text-gray-500 text-sm">${{ $item->price_per_day }}/day</p>
                        </div>
                    </div>
                    <img src="{{ $item->photos ? asset('storage/' . $item->photos) : '/images/default-car.jpg' }}"
                        alt="{{ $item->name }}" class="w-full h-32 object-contain mb-4">
                    <div class="flex justify-between text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-1"><i class="fas fa-car"></i>
                            {{ $item->transmission ?? 'Manual' }}</div>
                        <div class="flex items-center gap-1"><i class="fas fa-user-friends"></i> {{ $item->seats ?? '4' }}
                            Seats</div>
                        <div class="flex items-center gap-1"><i class="fas fa-gas-pump"></i> {{ $item->mpg ?? '30' }} MPG
                        </div>
                    </div>
                    @if($item->name === 'Honda Jazz RS')
                        <a href="#"
                            class="bg-[#4743FB] hover:bg-[#3a37d0] text-white text-center py-2 w-full rounded-md font-medium transition">Rent
                            Now</a>
                    @endif
                </div>
                <div class="car-item bg-white shadow-md rounded-2xl p-6 relative border transition hover:shadow-lg {{ $item->name === 'Honda Jazz RS' ? 'border-[#4743FB]' : '' }}"
                    data-brand="{{ $item->brand->name ?? 'Tanpa Brand' }}">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-lg font-semibold">{{ $item->name }}</h4>
                            <p class="text-gray-500 text-sm">${{ $item->price_per_day }}/day</p>
                        </div>
                    </div>
                    <img src="{{ $item->photos ? asset('storage/' . $item->photos) : '/images/default-car.jpg' }}"
                        alt="{{ $item->name }}" class="w-full h-32 object-contain mb-4">
                    <div class="flex justify-between text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-1"><i class="fas fa-car"></i>
                            {{ $item->transmission ?? 'Manual' }}</div>
                        <div class="flex items-center gap-1"><i class="fas fa-user-friends"></i> {{ $item->seats ?? '4' }}
                            Seats</div>
                        <div class="flex items-center gap-1"><i class="fas fa-gas-pump"></i> {{ $item->mpg ?? '30' }} MPG
                        </div>
                    </div>
                    @if($item->name === 'Honda Jazz RS')
                        <a href="#"
                            class="bg-[#4743FB] hover:bg-[#3a37d0] text-white text-center py-2 w-full rounded-md font-medium transition">Rent
                            Now</a>
                    @endif
                </div>
                <div class="car-item bg-white shadow-md rounded-2xl p-6 relative border transition hover:shadow-lg {{ $item->name === 'Honda Jazz RS' ? 'border-[#4743FB]' : '' }}"
                    data-brand="{{ $item->brand->name ?? 'Tanpa Brand' }}">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-lg font-semibold">{{ $item->name }}</h4>
                            <p class="text-gray-500 text-sm">${{ $item->price_per_day }}/day</p>
                        </div>
                    </div>
                    <img src="{{ $item->photos ? asset('storage/' . $item->photos) : '/images/default-car.jpg' }}"
                        alt="{{ $item->name }}" class="w-full h-32 object-contain mb-4">
                    <div class="flex justify-between text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-1"><i class="fas fa-car"></i>
                            {{ $item->transmission ?? 'Manual' }}</div>
                        <div class="flex items-center gap-1"><i class="fas fa-user-friends"></i> {{ $item->seats ?? '4' }}
                            Seats</div>
                        <div class="flex items-center gap-1"><i class="fas fa-gas-pump"></i> {{ $item->mpg ?? '30' }} MPG
                        </div>
                    </div>
                    @if($item->name === 'Honda Jazz RS')
                        <a href="#"
                            class="bg-[#4743FB] hover:bg-[#3a37d0] text-white text-center py-2 w-full rounded-md font-medium transition">Rent
                            Now</a>
                    @endif
                </div>
                <div class="car-item bg-white shadow-md rounded-2xl p-6 relative border transition hover:shadow-lg {{ $item->name === 'Honda Jazz RS' ? 'border-[#4743FB]' : '' }}"
                    data-brand="{{ $item->brand->name ?? 'Tanpa Brand' }}">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-lg font-semibold">{{ $item->name }}</h4>
                            <p class="text-gray-500 text-sm">${{ $item->price_per_day }}/day</p>
                        </div>
                    </div>
                    <img src="{{ $item->photos ? asset('storage/' . $item->photos) : '/images/default-car.jpg' }}"
                        alt="{{ $item->name }}" class="w-full h-32 object-contain mb-4">
                    <div class="flex justify-between text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-1"><i class="fas fa-car"></i>
                            {{ $item->transmission ?? 'Manual' }}</div>
                        <div class="flex items-center gap-1"><i class="fas fa-user-friends"></i> {{ $item->seats ?? '4' }}
                            Seats</div>
                        <div class="flex items-center gap-1"><i class="fas fa-gas-pump"></i> {{ $item->mpg ?? '30' }} MPG
                        </div>
                    </div>
                    @if($item->name === 'Honda Jazz RS')
                        <a href="#"
                            class="bg-[#4743FB] hover:bg-[#3a37d0] text-white text-center py-2 w-full rounded-md font-medium transition">Rent
                            Now</a>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.filter-btn');
            const cars = document.querySelectorAll('.car-item');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const brand = btn.getAttribute('data-brand');
                    cars.forEach(car => {
                        car.style.display = (car.getAttribute('data-brand') === brand) ? 'block' : 'none';
                    });
                });
            });
        });
    </script>
</x-front-layout>