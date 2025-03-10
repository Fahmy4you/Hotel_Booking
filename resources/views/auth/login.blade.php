@extends('layouts/auth')

@section('container')
        <!-- left side -->
        <form action="{{ route('loginPost') }}" method="POST" class="h-[500px] flex flex-col justify-center p-4 md:py-4 md:px-14">
          @csrf
          <span class="mb-3 text-4xl font-bold">Welcome back</span>
          <span class="font-light text-gray-400 mb-8">
            Welcome back! Please enter your details
          </span>
          <div class="py-4">
            @if (session()->has('succes'))
              <div class="bg-green-300/40 rounded-md mb-3 py-2 px-3">{{session('succes')}}</div>
            @endif
            @if (session()->has('error'))
              <div class="bg-red-300/40 rounded-md mb-3 py-2 px-3">{{session('error')}}</div>
            @endif
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
          <div class="py-4">
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
          <button type="submit"
            class="transition-all duration-300 w-full bg-black text-white p-2 border border-transparent rounded-lg mb-6 hover:bg-white hover:text-black hover:border-gray-300"
          >
            Sign in
          </button>
          <div class="text-center text-gray-400">
            Dont'have an account ?
            <a href="{{ route('register') }}" class="font-bold text-black">Sign up for free</a>
          </div>
        </form>
        <!-- {/* right side */} -->
        <div class="relative">
          <img
            src="{{ asset('image/auth/login.jpeg'); }}"
            alt="img"
            class="w-[400px] h-full hidden rounded-r-2xl md:block object-cover"
          />
          <!-- text on image  -->
          <div
            class="absolute hidden bottom-10 right-6 p-6 bg-gray-900 bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg md:block"
          >
            <span class="text-gray-100 text-xl"
              >Want to book a hotel at an <br />affordable price, comfortable and<br> safe ? Login now
            </span>
          </div>
        </div>
@endsection