@extends('layouts.main')

@section('content')

    <h1>Hello world</h1>

    <div style="margin-bottom: 700px" class="antialiased">
        <div class="flex flex-col space-y-4 p-4">
            @foreach($messages as $message)
                <div class="flex rounded-lg p-r @if ($message['role'] === 'assistant') bg-green-200 flex-reverse @else bg-blue-200 @endif ">
                    <div class="ml-4">
                        <div class="text-lg">
                            @if($message['role'] === 'assistant')
                                <a href="#" class="font-medium text-gray-900">ChatGPT</a>
                            @else
                                <a href="#" class="font-medium text-gray-900">Ви</a>
                            @endif
                        </div>
                        <div class="mt-1">
                            <p class="text-gray-600">
                                {{\Illuminate\Mail\Markdown::parse($message['content'])}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
                <form action="{{ route('openai.index') }}" class="p-4 flex space-x-4 justify-center items-center" method="POST">
                    @csrf
                    <label for="message">Запитай щось</label>
                    <input type="text" id="message" name="message" autocomplete="off" class="border rounded-md p-2 flex-1">
                    <a class="bg-gray-900 text-white p-2 rounded-md" href="{{ route('openai.reset') }}">Перезапустити чат</a>
                </form>
        </div>
    </div>

@endsection
