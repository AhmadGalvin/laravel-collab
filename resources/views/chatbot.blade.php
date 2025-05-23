<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot dengan LLaMA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 60px auto;
            padding: 30px;
            background-color: #ffffffcc;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        h1 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        textarea[name="prompt"] {
            width: 100%;
            height: 120px;
            font-size: 16px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            resize: vertical;
            background-color: #f9f9f9;
        }

        button {
            margin-top: 15px;
            padding: 12px 24px;
            font-size: 16px;
            color: white;
            background: linear-gradient(135deg, #6c5ce7, #a29bfe);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #5e50c2, #8e84f1);
        }

        .response-container {
            margin-top: 30px;
            padding: 20px;
            background-color: #f3f4f6;
            border-left: 4px solid #6c5ce7;
            border-radius: 10px;
        }

        #preview {
            white-space: pre-wrap;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chatbot Llama</h1>

        <form id="chat-form" method="POST" action="/ask-llama">
            @csrf
            <textarea name="prompt" placeholder="Tulis pertanyaanmu...">{{ old('prompt', session('prompt')) }}</textarea>
            <button type="submit">Kirim</button>
        </form>

        @if(session('response'))
        <div class="response-container">
            <strong>Jawaban:</strong>
            <textarea id="markdown" style="display: none;">{{ session('response') }}</textarea>
            <div id="preview"></div>
        </div>
        @endif
    </div>

    <script>
        const markdown = document.getElementById('markdown')?.value || '';
        document.getElementById('preview').innerHTML = marked.parse(markdown);
    </script>
</body>
</html>
