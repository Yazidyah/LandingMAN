<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <meta name="query-url" content="{{ env('CHATBOT_QUERY_URL', 'http://127.0.0.1:5000/query') }}">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Raleway|Ubuntu&display=swap");

        body {
            background: #E8EBF5;
            padding: 0;
            margin: 0;
            font-family: Raleway;
        }

        .chat-box {
            height: 70%;
            width: 400px;
            position: absolute;
            margin: 0 auto;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            z-index: 15;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.005);
            right: 0;
            bottom: 0;
            margin: 15px;
            background: #fff;
            border-radius: 15px;
            visibility: hidden;
        }

        .chat-box-header {
            height: 8%;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            display: flex;
            font-size: 14px;
            padding: 0.5em 0;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.025);
            background: #006316;
            color: white;
            justify-content: space-between;
            align-items: center;
            padding: 0 15px;
        }

        .chat-box-body {
            height: 75%;
            background: #f8f8f8;
            overflow-y: scroll;
            padding: 12px;
            display: flex;
            flex-direction: column;
        }

        .chat-box-body-send {
            max-width: 70%;
            align-self: flex-end;
            background: #006316;
            color: white;
            padding: 10px 15px;
            border-radius: 15px 15px 0 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.015);
            margin-bottom: 14px;
            word-wrap: break-word;
        }

        .chat-box-body-receive {
            max-width: 70%;
            align-self: flex-start;
            background: #e4e6eb;
            color: black;
            padding: 10px 15px;
            border-radius: 15px 15px 15px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.015);
            margin-bottom: 14px;
            word-wrap: break-word;
        }

        .chat-box-body-send p,
        .chat-box-body-receive p {
            margin: 0;
            font-size: 14px;
            margin-bottom: 0.25rem;
        }

        .chat-box-body-send span,
        .chat-box-body-receive span {
            float: right;
            color: #777;
            font-size: 10px;
        }

        .chat-box-footer {
            display: flex;
            align-items: center;
            padding: 10px;
            border-top: 1px solid #ddd;
            position: absolute;
            bottom: 0;
            width: 90%;
            background: white;
        }

        .chat-box-footer input {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 50px;
            background: whitesmoke;
            margin: 0 10px;
            font-family: ubuntu;
            font-weight: 600;
            color: #444;
        }

        .chat-box-footer input:focus {
            outline: none;
        }

        .chat-box-footer .send {
            cursor: pointer;
            font-size: 20px;
            color: #006316;
        }

        .chat-button {
            padding: 25px 16px;
            background: #006316;
            width: 120px;
            position: absolute;
            bottom: 0;
            right: 0;
            margin: 15px;
            border-radius: 25px;
            color: white;
            text-align: center;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="chat-box">
        <div class="chat-box-header">
            <h3>Chatbot AI</h3>
            <p class="close-btn" title="Tutup chat" style="cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6" style="width: 1.5rem; height: 1.5rem;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </p>
        </div>
        <div class="chat-box-body" id="chat-messages"></div>
        <div class="chat-box-footer">
            <input type="text" id="query" placeholder="Enter Your Message" required>
            <i class="send far fa-paper-plane" id="send-button"></i>
        </div>
    </div>
    <div class="chat-button"><span><b>Coba Chat dengan Chatbot</b></span></div>
    <script>
        const chatMessages = document.getElementById('chat-messages');
        const queryInput = document.getElementById('query');
        const sendButton = document.getElementById('send-button');
        const chatBox = document.querySelector('.chat-box');
        const chatButton = document.querySelector('.chat-button');
        const closeButton = document.querySelector('.chat-box-header p');
        const queryUrl = document.querySelector('meta[name="query-url"]').getAttribute('content');

        function appendMessage(content, sender) {
            const messageElement = document.createElement('div');
            const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            messageElement.classList.add(sender === 'user' ? 'chat-box-body-send' : 'chat-box-body-receive');
            messageElement.innerHTML = `<p>${content}</p><span style="color: ${sender === 'user' ? 'white' : '#777'};">${time}</span>`;
            chatMessages.appendChild(messageElement);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        sendButton.addEventListener('click', async function () {
            const query = queryInput.value.trim();
            if (!query) return;

            appendMessage(query, 'user');
            queryInput.value = '';

            try {
                const response = await fetch(queryUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ query_text: query }),
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                if (data.response) {
                    appendMessage(data.response, 'bot');
                } else {
                    appendMessage("Maaf saya sedang offline, Coba lagi lain kali ya", 'bot');
                }
            } catch (error) {
                appendMessage("Maaf saya sedang offline, Coba lagi lain kali ya", 'bot');
            }
        });

        queryInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendButton.click();
            }
        });

        chatButton.addEventListener('click', function () {
            chatBox.style.visibility = 'visible';
            chatButton.style.display = 'none';

            // Add initial greeting message
            if (!chatMessages.hasChildNodes()) {
                appendMessage('Assalamualaikum ada yang bisa saya bantu?', 'bot');
            }
        });

        closeButton.addEventListener('click', function () {
            chatBox.style.visibility = 'hidden';
            chatButton.style.display = 'block';
        });
    </script>
</body>

</html>