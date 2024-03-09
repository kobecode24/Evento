@extends('layouts.organizer.app')


@section('contents')
    <div class="container px-6 py-8 mx-auto">
        <h3 class="text-3xl font-medium text-gray-700">
            Dashboard
        </h3>


        <div class="flex flex-col mt-8">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Holy smokes!</strong>
                    <span class="block sm:inline">Please check the following errors:</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <span class="block sm:inline">{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Well done!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Holy smokes!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
                <div class="w-full mx-auto bg-white p-6 rounded-md shadow-md">
                    <h2 class="text-xl font-medium text-gray-700">Events List</h2>
                    <div class="overflow-x-auto mt-6">
                        <div class="mb-4">
                            <a href="{{ route('organizer.events.create') }}" class="px-4 py-2 bg-green-500 text-white text-sm font-bold uppercase rounded hover:bg-green-600 focus:outline-none focus:bg-green-700 transition duration-150 ease-in-out">
                                Add New Event
                            </a>
                        </div>
                        <table class="table-auto w-full">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Title</th>
                                <th class="py-3 px-6 text-left">Date</th>
                                <th class="py-3 px-6 text-left">Location</th>
                                <th class="py-3 px-6 text-left">Available Slots</th>
                                <th class="py-3 px-6 text-left">Price</th>
                                <th class="py-3 px-6 text-left">Status</th>
                                <th class="py-3 px-6 text-center ">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($events as $event)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <span class="font-medium bg">{{ $event->title }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $event->date->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $event->location }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $event->available_slots }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        ${{ number_format($event->price, 2) }}
                                    </td>
                                        <td>
                                        @switch($event->status)
                                            @case(0)
                                            @case(1)
                                                <span class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                                    <span aria-hidden="true" class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">Pending</span>
                                                </span>
                                                @break
                                            @case(2)
                                            @case(3)
                                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                <span class="relative">Accepted</span>
            </span>
                                                @break
                                            @case(4)
                                            @case(5)
                                                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                <span aria-hidden="true" class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                <span class="relative">Refused</span>
            </span>
                                                @break
                                            @case(6)
                                                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                <span aria-hidden="true" class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                <span class="relative">Cancelled</span>
            </span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center space-x-2">
                                            @if($event->status != '6')
                                            <a href="{{ route('organizer.events.edit', $event->id) }}" class="mr-3 text-green-600 hover:text-green-900">Edit</a>
                                            <a href="{{ route('organizer.events.cancel', $event->id) }}" class="mr-3 text-red-600 hover:text-green-900">Cancel</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@endsection
