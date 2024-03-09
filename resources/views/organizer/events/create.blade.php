@extends('layouts.organizer.app')


@section('contents')


        <div class="container mx-auto px-6 py-8">

            <div class="mt-6">
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
                    <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-md">
                        <h2 class="text-xl font-medium text-gray-700">Create New Event</h2>
                        <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-4">
                                <label class="block" for="title">Event Title</label>
                                <input type="text" placeholder="Event Title" name="title" id="title" class="mt-2 p-2 bg-gray-100 rounded-md w-full" required>
                            </div>
                            <div class="mt-4">
                                <label class="block" for="description">Event Description</label>
                                <textarea name="description" id="description" class="mt-2 p-2 bg-gray-100 rounded-md w-full" required></textarea>
                            <div class="mt-4">
                                <label class="block" for="date">Event Date</label>
                                <input type="datetime-local" name="date" id="date" class="mt-2 p-2 bg-gray-100 rounded-md w-full" required>
                            </div>
                            <div class="mt-4">
                                <label class="block" for="location">Location</label>
                                <input type="text" placeholder="Event Location" name="location" id="location" class="mt-2 p-2 bg-gray-100 rounded-md w-full" required>
                            </div>
                            <div class="mt-4">
                                <label class="block" for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="mt-2 p-2 bg-gray-100 rounded-md w-full">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <label class="block" for="available_slots">Available Slots</label>
                                <input type="number" name="available_slots" id="available_slots" class="mt-2 p-2 bg-gray-100 rounded-md w-full" required>
                            </div>
                            <div class="mt-4">
                                <label class="block" for="price">Price</label>
                                <input type="text" placeholder="Event Price" name="price" id="price" class="mt-2 p-2 bg-gray-100 rounded-md w-full" required>
                            </div>
                            <div class="mt-4">
                                <label class="block" for="image">Event Image</label>
                                <input type="file" name="image" id="image" class="mt-2 p-2 bg-gray-100 rounded-md w-full">
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="manual_validation" name="manual_validation" class="w-4 h-4 text-blue-600 form-checkbox">
                                    <label for="manual_validation" class="ml-2 block text-sm leading-5 text-gray-900">Manual Validation</label>
                                </div>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Create Event</button>
                            </div>
                            </div>
                        </form>
                    </div>

            </div>


        </div>
@endsection
