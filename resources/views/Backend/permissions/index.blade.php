@extends('Backend.master')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="page-content">
        <div class="container-fluid">
    <div>
        <main class=" overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">
                <div class="text-right">

                    <a href="{{ route('permission.create') }}"
                        class="bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New
                        Permission</a>
                </div>
                <div class="bg-white shadow-md rounded my-6">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">
                                    Permission Name</th>

                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($permissions as $permission)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $permission->name }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light text-right">
                                        <a href="{{ route('permission.edit', $permission->id) }}"
                                            class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                        <form action="{{ route('permission.destroy', $permission->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('delete')
                                            <button
                                                class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>
    </div>
    </div>
    </div>

@endsection
