@extends('layout')
@section('content')
    @include('partials.search');
    <a href="{{ route('listings.index') }}" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i>
        Back
    </a>
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <div class="flex flex-col items-center justify-center text-center">
                <img class=" w-48 mr-6 md:block"
                    src="{{ $listing->logo ? route('ListImage.show', $listing->logo) : asset('images/no-image.png') }}"
                    alt="" />
                <h3 class="text-2xl mb-2">{{ $listing->title }}</h3>
                <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                @php
                    $tags = explode(',', $listing->tags);
                @endphp
                <ul class="flex">
                    @foreach ($tags as $tag)
                        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                            <a href="/?tag={{ $tag }}">{{ $tag }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        {{ $listing->description }}

                        <a href="mailto:{{ $listing->email }}"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            Contact Employer</a>

                        <a href="https://{{ $listing->website }}" target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-globe"></i> Visit
                            Website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 p-2 flex space-x-6">
        <a href="{{ route('listing.edit', $listing->id) }}">
            <i class="fa-solid fa-pencil"></i> Edit
        </a>
        <form method="POST" action="{{ route('listing.destroy', $listing->id) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
        </form>
    </div>
@endsection
