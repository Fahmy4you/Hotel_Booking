@extends('layouts/auth')

@section('container')
        <!-- left side -->
        <div class="relative">
            <img
              src="{{ asset('image/auth/register.jpeg'); }}"
              alt="img"
              class="w-[400px] h-full hidden rounded-l-2xl md:block object-cover"
            />
            <!-- text on image  -->
            <div
              class="absolute hidden bottom-10 right-6 p-6 bg-gray-900 bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg md:block"
            >
              <span class="text-gray-100 text-xl"
                >Want to book a hotel at an <br />affordable price, comfortable and<br> safe ? Register now
              </span>
            </div>
          </div>
        

        <!-- {/* right side */} -->
        <form action="{{ route('registerPost') }}" method="POST" class="flex flex-col justify-center p-4 md:py-4 md:px-14">
          @csrf
            <span class="mb-3 text-4xl font-bold">Register Now</span>
            <span class="font-light text-gray-400 mb-8">
                Register now to get the best room
            </span>
            <div class="py-2">
              <span class="mb-2 text-md">Full Name</span>
              <input
                type="text"
                class="@error('name') border-red-500 @enderror w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                name="name"
                value="{{ old('name') }}"
              @error('name')
                  autofocus
              @enderror
                id="name"
              />
              @error('name')
              <p class="text-[12px] mt-1 text-red-700">{{ $message }}</p>
              @enderror
            </div>
            <div class="py-2">
              <span class="mb-2 text-md">Email</span>
              <input
              type="text"
              class="@error('email') border-red-500 @enderror w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
              name="email"
              value="{{ old('email') }}"
              @error('email')
                  autofocus
              @enderror
              id="email"
              />
              @error('email')
              <p class="text-[12px] mt-1 text-red-700">{{ $message }}</p>
              @enderror
            </div>
            <div class="py-2">
              <span class="mb-2 text-md">Password</span>
              <input
              type="password"
              name="password"
              id="password"
              @error('password')
                  autofocus
              @enderror
              class="@error('password') border-red-500 @enderror w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
              />
              @error('password')
              <p class="text-[12px] mt-1 text-red-700">{{ $message }}</p>
              @enderror
            </div>
            <div class="py-2">
              <span class="mb-2 text-md">Konfirmasi Password</span>
              <input
              type="password"
              name="password_confirmation"
              id="password_confirmation"
              @error('password_confirmation')
              autofocus
          @enderror
              class="@error('password_confirmation') border-red-500 @enderror w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
              />
              @error('password_confirmation')
              <p class="text-[12px] mt-1 text-red-700">{{ $message }}</p>
              @enderror
            </div>
            <button
              class="mt-3 transition-all duration-300 w-full bg-black text-white p-2 border border-transparent rounded-lg mb-6 hover:bg-white hover:text-black hover:border-gray-300"
            >
              Sign Up
            </button>
            <div class="text-center text-gray-400">
              Do have an account ?
              <a href="{{ route('login') }}" class="font-bold text-black">Sign in for free</a>
            </div>
          </form>
@endsection