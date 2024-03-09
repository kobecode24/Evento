@extends('layouts.admin.app')


@section('contents')
    <div class="container px-6 py-8 mx-auto">
        <h3 class="text-3xl font-medium text-gray-700">
            Dashboard
        </h3>


        <div class="flex flex-col mt-8">
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
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-10 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Name
                            </th>

                            <th class="px-10 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Email
                            </th>

                            <th class="px-10 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Role
                            </th>

                            <th class="px-10 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                State
                            </th>

                            <th class="px-10 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Action
                            </th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                       @foreach ($users as $user)
                               <td class="py-3 px-6 text-left whitespace-nowrap">
                                   <div class="flex items-center">
                                       <div class="flex items-center">
                                           <div class="flex-shrink-0 w-10 h-10">
                                               <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt=""/>
                                           </div>
                                       </div>
                                       <div class="ml-4">
                                           <div class="text-sm font-medium leading-5 text-gray-900">
                                               {{ $user->name }}
                                           </div>
                                   </div>
                                   </div>
                               </td>
                               <td class="py-3 px-6 text-left whitespace-nowrap">
                                   <div class="flex items-center">
                                       <span>{{ $user->email }}</span>
                                   </div>
                               </td>
                               <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                   @if($user->roles->isNotEmpty())
                                       @foreach($user->roles as $role)
                                           <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-600 bg-red-100 rounded-full">
            {{ $role->name }}
        </span>
                                       @endforeach
                                   @else
                                       <span class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-600 bg-gray-100 rounded-full">
            No Role
        </span>
                                   @endif
                               </td>

                               <td class="py-3 px-6 text-center">
                                   {{ $user->status ? 'Banned' : 'Active' }}
                               </td>
                               <td class="py-3 px-6 text-center">
                                   <div class="flex item-center justify-center space-x-2">
                                       @if(!$user->status)
                                           <a href="{{ route('admin.users.ban', $user->id) }}" class="transform hover:text-purple-500 hover:scale-110">
                                               <button class="px-2 py-1 bg-yellow-500 text-white text-xs font-bold uppercase rounded">Ban</button>
                                           </a>
                                       @else
                                           <a href="{{ route('admin.users.unban', $user->id) }}" class="transform hover:text-purple-500 hover:scale-110">
                                               <button class="px-2 py-1 bg-green-500 text-white text-xs font-bold uppercase rounded">Unban</button>
                                           </a>
                                       @endif
                                           <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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
