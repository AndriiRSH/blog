<?php

namespace App\Http\Controllers\OpenAI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class OpenAIController extends Controller
{
    public function index()
    {
        $messages = collect(session('messages', []))->reject(fn($message)=>
        $message['role'] === 'system');

        return view('openai.index', [
           'messages' => $messages
        ]);
    }

    public function store(Request $request)
    {
        try {
            $messages = $request->session()->get('messages',[
                ['role' => 'system', 'content' => 'You are GPT Laravel clone']
            ]);

            $messages[] = ['role' => 'user', 'content' => $request->input('message')];
//            dd(1);
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages
            ]);
            dd($response);
            $messages[] = ['role' => 'assistant', 'content' => $response->choices[0]->message->content];
            $request->session()->put('messages', $messages);
            return redirect()->route('openai.index');
        } catch (\Exception $e) {
            Log::channel('file_info')->alert('Error in OpenAIController@store: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while processing your request.');
        }
    }

    public function destroy(Request $request){
        $request->session()->forget('messages');
        return redirect()->route('openai.index');
    }
}
