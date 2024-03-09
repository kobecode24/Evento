@extends('layouts.admin.app')


@section('contents')
    <div class="container px-6 py-8 mx-auto">

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
                        <h2 class="text-xl font-medium text-gray-700">Create New Category</h2>
                        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-4">
                                <label class="block" for="name">Category Name</label>
                                <input type="text" placeholder="Category Name" name="name" id="name" class="mt-2 p-2 bg-gray-100 rounded-md w-full" required>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Create</button>
                            </div>
                        </form>
                    </div>

            </div>


        </div>
@endsection
