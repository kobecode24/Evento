@extends('layouts.organizer.app')


@section('contents')
    <div class="container px-6 py-8 mx-auto">

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
                        <div class="w-full mx-auto bg-white p-6 rounded-md shadow-md">
                            <h2 class="text-xl font-medium text-gray-700">Reservations List</h2>
                            <div class="overflow-x-auto mt-6">
                                <table class="table-auto w-full">
                                    <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Event</th>
                                        <th class="py-3 px-6 text-left">User</th>
                                        <th class="py-3 px-6 text-left">Status</th>
                                        <th class="py-3 px-6 text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($reservations as $reservation)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <span class="font-medium">{{ $reservation->event->title }}</span>
                                            </td>
                                            <td class="py-3 px-6 text-left">
                                                {{ $reservation->user->name }}
                                            </td>
                                            <td class="py-3 px-6 text-left">
                                                @switch($reservation->status)
                                                    @case(0)
                                                        <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-orange-800 bg-orange-200 rounded-full">Pending</span>
                                                        @break
                                                    @case(1)
                                                        <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-200 rounded-full">Accepted</span>
                                                        @break
                                                    @case(2)
                                                        <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-red-800 bg-red-200 rounded-full">Declined</span>
                                                        @break
                                                    @case(3)
                                                    @case(4)
                                                    @case(5)
                                                        <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-red-800 bg-red-200 rounded-full">Cancelled</span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div class="flex item-center justify-center space-x-2">
                                                    @if(!$reservation->status==1)
                                                    <a href="{{ route('organizer.reservations.accept', $reservation->id) }}" class="text-blue-600 hover:text-blue-900">Accept</a>
                                                    <a href="{{ route('organizer.reservations.decline', $reservation->id) }}" class="text-red-600 hover:text-red-900">Decline</a>
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
        </div>
    </div>
@endsection
