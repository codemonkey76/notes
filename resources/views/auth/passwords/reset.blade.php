@extends('layouts.app')

@section('content')

    <div class="mx-auto h-full flex justify-center items-center bg-gray-300">
        <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
            <svg class="fill-current text-white w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <path d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM192 40c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm144 418c0 3.3-2.7 6-6 6H54c-3.3 0-6-2.7-6-6V118c0-3.3 2.7-6 6-6h42v36c0 6.6 5.4 12 12 12h168c6.6 0 12-5.4 12-12v-36h42c3.3 0 6 2.7 6 6z"/>
            </svg>

            <h1 class="text-white text-3xl pt-8">Reset your password</h1>
            <h5 class="text-blue-300 pt-2">Enter your new credentials below</h5>

            <form
                method="POST"
                action="{{ route('password.update') }}"
                class="pt-8">
                @csrf
                <?php $token = Str::random(32) ?>
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="relative">
                    <label for="email"
                           class="absolute uppercase text-blue-500 text-xs font-bold pl-3 pt-2">E-mail</label>
                    <input class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700"
                           id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email"
                           autofocus placeholder="your@email.com" required>
                    @error('email')
                    <p class="text-red-500 text-xs italic my-2">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="relative pt-3">
                    <label class="absolute uppercase text-blue-500 text-xs font-bold pl-3 pt-2"
                           for="password">Password</label>
                    <input class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700"
                           id="password" type="password" name="password" autocomplete="new-password" required>
                    @error('password')
                    <p class="text-red-500 text-xs italic my-2">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="relative pt-3">
                    <label class="absolute uppercase text-blue-500 text-xs font-bold pl-3 pt-2"
                           for="password-confirm">Confirm Password</label>
                    <input class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700"
                           id="password-confirm" type="password" name="password_confirmation"
                           autocomplete="new-password" required>
                </div>

                <div class="pt-8">
                    <button type="submit"
                            class="py-2 px-3 text-left w-full bg-gray-400 uppercase rounded text-blue-800 font-bold">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
