<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CPSU Chat Assistant 🤖</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: #f2f8f3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-container {
            width: 100%;
            max-width: 450px;
            height: 90vh;
            background: #ffffff;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .chat-header {
            background: #007a33;
            color: white;
            padding: 16px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
        }

        .chat-box {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .msg {
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 18px;
            line-height: 1.4;
            word-wrap: break-word;
            animation: fadeIn 0.3s ease;
        }

        .bot {
            align-self: flex-start;
            background: #e9f5ec;
            color: #003314;
            border-bottom-left-radius: 0;
        }

        .user {
            align-self: flex-end;
            background: #007a33;
            color: white;
            border-bottom-right-radius: 0;
        }

        .input-area {
            display: flex;
            border-top: 1px solid #eee;
        }

        .input-area input {
            flex: 1;
            padding: 12px 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }

        .input-area button {
            background: #007a33;
            color: white;
            border: none;
            padding: 0 20px;
            cursor: pointer;
            font-size: 15px;
            transition: background 0.2s;
        }

        .input-area button:hover {
            background: #005f27;
        }

        .typing {
            font-style: italic;
            color: gray;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 500px) {
            .chat-container {
                height: 100vh;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
<div class="chat-container">
    <div class="chat-header">CPSU Chat Assistant 🤖</div>
    <div id="chat-box" class="chat-box">
        <div class="msg bot">
            Hi there! 👋<br>
            I'm your CPSU Chat Assistant. Ask me anything about Central Philippine State University!
        </div>
    </div>
    <div class="input-area">
        <input id="user-input" type="text" placeholder="Type your question...">
        <button id="send-btn">Send</button>
    </div>
</div>

<script>
const input = document.getElementById('user-input');
const sendBtn = document.getElementById('send-btn');
const chatBox = document.getElementById('chat-box');

function appendMessage(content, sender='bot') {
    const msg = document.createElement('div');
    msg.classList.add('msg', sender);
    msg.innerHTML = content;
    chatBox.appendChild(msg);
    chatBox.scrollTop = chatBox.scrollHeight;
}

async function typeMessage(text) {
    const msg = document.createElement('div');
    msg.classList.add('msg', 'bot');
    chatBox.appendChild(msg);
    chatBox.scrollTop = chatBox.scrollHeight;
    for (let i = 0; i < text.length; i++) {
        msg.innerHTML = text.substring(0, i+1);
        await new Promise(r => setTimeout(r, 10));
        chatBox.scrollTop = chatBox.scrollHeight;
    }
}

async function sendMessage() {
    const question = input.value.trim();
    if (!question) return;

    appendMessage(question, 'user');
    input.value = '';
    sendBtn.disabled = true;

    appendMessage('<span class="typing">Bot is typing...</span>', 'bot');

    try {
        const res = await fetch('{{ route("chatbot.chat.ask") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: question })
        });

        const data = await res.json();
        const typingMsg = chatBox.querySelector('.typing');
        if (typingMsg) typingMsg.parentElement.remove();
        sendBtn.disabled = false;

        if (data.answer) {
            appendMessage(data.answer, 'bot');

            // Optional: retry if model is loading
            if (data.answer.includes('Model is loading')) {
                setTimeout(sendMessage, 2000);
            }
        } else {
            appendMessage('⚠️ Sorry, I could not get a response from CPSU.', 'bot');
        }

    } catch(err) {
        const typingMsg = chatBox.querySelector('.typing');
        if (typingMsg) typingMsg.parentElement.remove();
        sendBtn.disabled = false;
        appendMessage('⚠️ Sorry, something went wrong while contacting the server.', 'bot');
    }
}

sendBtn.addEventListener('click', sendMessage);
input.addEventListener('keypress', e => {
    if (e.key === 'Enter') sendMessage();
});
</script>
</body>
</html>
