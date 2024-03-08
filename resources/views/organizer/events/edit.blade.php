@extends('layouts.organizer.app')

@section('contents')
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Edit Event</h2>
            </div>
            <div class="my-5">
                <a href="{{ route('organizer.events.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Event List
                </a>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('organizer.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="shadow overflow-hidden sm:rounded-md">
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
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="form-input mt-1 block w-full" value="{{ $event->title }}" required>

                            <label for="description" class="block text-sm font-medium text-gray-700 mt-4">Description</label>
                            <textarea name="description" id="description" class="form-textarea mt-1 block w-full" rows="3" required>{{ $event->description }}</textarea>

                            <label for="date" class="block text-sm font-medium text-gray-700 mt-4">Date and Time</label>
                            <input type="datetime-local" name="date" id="date" class="form-input mt-1 block w-full" value="{{ $event->date->format('Y-m-d\TH:i') }}" required>

                            <label for="location" class="block text-sm font-medium text-gray-700 mt-4">Location</label>
                            <input type="text" name="location" id="location" class="form-input mt-1 block w-full" value="{{ $event->location }}" required>

                            <label for="available_slots" class="block text-sm font-medium text-gray-700 mt-4">Available Slots</label>
                            <input type="number" name="available_slots" id="available_slots" class="form-input mt-1 block w-full" value="{{ $event->available_slots }}" required>

                            <label for="price" class="block text-sm font-medium text-gray-700 mt-4">Price</label>
                            <input type="text" name="price" id="price" class="form-input mt-1 block w-full" value="{{ $event->price }}" required>

                            <label for="category_id" class="block text-sm font-medium text-gray-700 mt-4">Category</label>
                            <select name="category_id" id="category_id" class="form-select mt-1 block w-full">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                            <label for="image" class=" font-medium text-gray-700 mt-4">Image</label>
                            <input type="file" name="image" id="image" class="form-input mt-1 block w-full" >

                            <div class="mt-4 flex items-center">
                                <input type="checkbox" name="manual_validation" id="manual_validation" {{ $event->status == '1' ? 'checked' : '' }} class="form-checkbox">
                                <label for="manual_validation" class="ml-2 block text-sm font-medium text-gray-700">Manual Validation</label>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Update Event
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
