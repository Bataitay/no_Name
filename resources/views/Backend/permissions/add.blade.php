@extends('Backend.master')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-1">
                        <div class="bg-white shadow-md rounded my-6 p-5">
                            <form method="POST" action="{{ route('permission.store') }}">
                                @csrf
                                <div class="flex flex-col space-y-2">
                                    <label for="role_name" class="text-gray-700 select-none font-medium">Permission
                                        Name</label>
                                    <input id="role_name" type="text" name="name" value="{{ old('name') }}"
                                        placeholder="Enter permission"
                                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                                </div>
                                <div class="text-center mt-16">
                                    <button type="submit"
                                        class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
                                    <a href="{{ route('permission.index') }}"
                                        class="bg-red-600 text-white font-bold px-5 py-1.5 rounded focus:outline-none shadow hover:bg-red-600 transition-colors ">cancel</a>
                                </div>
                        </div>
                    </div>x
                </main>
            </div>
        </div>
    </div>
    <style>
        img {
            display: inline-grid;
            vertical-align: middle;
        }
    </style>
@endsection
