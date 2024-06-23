@extends('layout')
@section('content')
    @include('partials.hero');
    @include('partials.search');


    @unless (count($listings) == 0)
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
            @foreach ($listings as $listing)
                <div class="bg-gray-50 border border-gray-200 rounded p-6">
                    <div class="flex">
                        <img class=" w-48 mr-6 md:block"
                            src="{{ $listing->logo ? 'storage/' . $listing->logo : asset('images/no-image.png') }}"
                            alt="" />

                        <div>
                            <h3 class="text-2xl">
                                <a href="{{ route('listings.show', $listing->id) }}">{{ $listing->title }}</a>
                            </h3>
                            <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                            @php
                                $tags = explode(',', $listing->tags);
                            @endphp
                            <ul class="flex">
                                @foreach ($tags as $tag)
                                    <li
                                        class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                                        <a href="{{ route('tag.show', $tag) }}">{{ $tag }}</a>
                                    </li>
                                @endforeach
                            </ul>



                            <div class="text-lg mt-4">
                                <i class="fa-solid fa-location-dot"></i>{{ $listing->location }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h1 class="text-center ">No Listings Found</h1>
        @endunless
    </div>
    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>
@endsection
