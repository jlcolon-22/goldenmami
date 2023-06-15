@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="w-[400px] bg-white shadow">
            <div class="flex justify-center bg-green-400 p-4 rounded-t">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="40px" height="40px" x="0" y="0" viewBox="0 0 2.54 2.54" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><circle cx="1.27" cy="1.27" r="1.27" fill="#00ba00" data-original="#00ba00" class=""></circle><path fill="#ffffff" d="M.873 1.89.41 1.391a.17.17 0 0 1 .008-.24.17.17 0 0 1 .24.009l.358.383.567-.53a.17.17 0 0 1 .016-.013l.266-.249a.17.17 0 0 1 .24.008.17.17 0 0 1-.008.24l-.815.76-.283.263-.125-.134z" data-original="#ffffff"></path></g></svg>
            </div>
            <h1 class="text-center text-2xl p-3 font-inter">Payment Success!</h1>
            <div class="flex justify-center pb-3">
                <a href="/" class="bg-green-200 text-green-600 font-bold px-4 py-2 rounded">Continue</a>
            </div>
        </div>

    </div>
@endsection
