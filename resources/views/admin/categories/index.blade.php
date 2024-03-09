@extends('layouts.admin.app')


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
                    <div class="w-full mx-auto bg-white p-6 rounded-md shadow-md">

                        <h2 class="text-xl font-medium text-gray-700">Categories List</h2>
                        <div class="overflow-x-auto mt-6">
                            <div class="mb-4">
                                <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-green-500 text-white text-sm font-bold uppercase rounded hover:bg-green-600 focus:outline-none focus:bg-green-700 transition duration-150 ease-in-out">
                                    Add New Category
                                </a>
                            </div>
                            <table class="table-auto w-full">
                                <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Name</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                @foreach ($categories as $category)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium">{{ $category->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center space-x-2">
                                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="transform hover:text-purple-500 hover:scale-110">
                                                    <button class="px-2 py-1 bg-blue-500 text-white text-xs font-bold uppercase rounded">Edit</button>
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white text-xs font-bold uppercase rounded">Delete</button>
                                                </form>
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
