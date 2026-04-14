<!DOCTYPE html>
<html lang="en">
@include('web.layouts.header')
@include('web.layouts.footer')
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
   
    <!-- DESCRIPTION -->
    <meta name="description" content="CPSU Official Website" />
   
    <!-- DESCRIPTION -->
    <title>CPSU</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('images/cpsu-logo.png') }}" type="image/png">
       
    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="{{ asset('css/jquery.nice-number.min.css') }}">
    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Chatbot Marked.js -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <!-- Chatbot Styles -->
    <style>
        /* Chatbot Floating Container */
        .chat-container {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 400px;
            height: 500px;
            background: #ffffff;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 1000;
            display: none; /* Initially hidden */
        }
        .chat-header {
            background-color: #28a745;
            color: white;
            padding: 15px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .chat-header .header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .chat-header img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .chat-header .close-btn {
            cursor: pointer;
            font-size: 1.5em;
            font-weight: bold;
            transition: opacity 0.2s ease;
        }
        .chat-header .close-btn:hover {
            opacity: 0.7;
        }
        .chat-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
            scroll-behavior: smooth;
        }
        .message {
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 15px;
            line-height: 1.4;
            font-size: 15px;
            word-wrap: break-word;
        }
        .user-message {
            align-self: flex-end;
            background-color: #dcf8c6;
            border-bottom-right-radius: 0;
        }
        .bot-message {
            align-self: flex-start;
            background-color: #f0f0f0;
            border-bottom-left-radius: 0;
        }
        /* NEW: Citation Styles for Relevant Items */
        .citations {
            margin-top: 8px;
            padding: 8px;
            background-color: #e9ecef;
            border-radius: 8px;
            font-size: 12px;
            line-height: 1.3;
        }
        .citations a {
            color: #007bff;
            text-decoration: none;
            margin-right: 8px;
        }
        .citations a:hover {
            text-decoration: underline;
        }
        .chat-footer {
            display: flex;
            padding: 10px;
            background-color: #fafafa;
            border-top: 1px solid #ddd;
        }
        .chat-footer input {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 10px 15px;
            outline: none;
            font-size: 16px; /* Prevent zoom on iOS */
        }
        .chat-footer button {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-left: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
            min-width: 44px; /* Touch target size */
            min-height: 44px;
        }
        .chat-footer button:hover {
            background-color: #218838;
        }
        .chat-footer button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .loading {
            color: #888;
            font-style: italic;
        }
        /* Floating Toggle Button */
        .chat-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 999;
            transition: transform 0.3s;
            min-width: 44px;
            min-height: 44px;
        }
        .chat-toggle:hover {
            transform: scale(1.05);
        }
        .chat-toggle img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        /* Scrollbar for chat body */
        .chat-body::-webkit-scrollbar {
            width: 6px;
        }
        .chat-body::-webkit-scrollbar-thumb {
            background: #bbb;
            border-radius: 3px;
        }
        /* Ensure no conflicts with existing body styles */
        body {
            position: relative;
        }
        /* Responsive Design for Smaller Screens */
        @media (max-width: 768px) {
            .chat-container {
                width: calc(100vw - 40px);
                height: 70vh;
                bottom: 80px;
                right: 20px;
                left: 20px;
                max-width: none;
            }
            .chat-header {
                font-size: 1.1em;
                padding: 12px;
            }
            .chat-header img {
                width: 25px;
                height: 25px;
            }
            .chat-body {
                padding: 10px;
            }
            .message {
                font-size: 14px;
                padding: 8px 12px;
            }
            .citations {
                font-size: 11px;
                padding: 6px;
            }
            .chat-footer {
                padding: 8px;
            }
            .chat-footer input {
                padding: 12px 15px;
                font-size: 16px;
            }
            .chat-footer button {
                width: 44px;
                height: 44px;
                margin-left: 8px;
            }
            .chat-toggle {
                bottom: 20px;
                right: 20px;
                width: 56px;
                height: 56px;
            }
            .chat-toggle img {
                width: 36px;
                height: 36px;
            }
        }
        @media (max-width: 480px) {
            .chat-container {
                bottom: 70px;
                height: 60vh;
                border-radius: 10px;
            }
            .chat-header {
                font-size: 1em;
                padding: 10px;
            }
            .chat-header img {
                width: 22px;
                height: 22px;
            }
            .chat-body {
                padding: 8px;
                gap: 8px;
            }
            .message {
                max-width: 90%;
                font-size: 13px;
                padding: 6px 10px;
            }
            .citations {
                font-size: 10px;
                padding: 4px;
            }
            .chat-footer {
                padding: 6px;
            }
            .chat-footer input {
                padding: 10px 12px;
            }
        }
        /* Landscape orientation on mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .chat-container {
                height: 80vh;
            }
        }
        /* Accessibility Focus Styles */
        .chat-toggle:focus,
        .chat-footer button:focus,
        .chat-footer input:focus,
        .chat-header:focus {
            outline: 2px solid #ffffff00;
            outline-offset: 2px;
        }
        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .chat-header {
                border-bottom: 2px solid #000;
            }
            .message {
                border: 1px solid #000;
            }
        }
        /* Reduced motion for animations */
        @media (prefers-reduced-motion: reduce) {
            .chat-toggle {
                transition: none;
            }
            .chat-footer button {
                transition: none;
            }
        }
    </style>
</head>
<body id="bg">
    <div class="page-wraper">
        <!--<div id="loading-icon-bx"></div>-->
        <!-- Header Top ==== -->
        @yield('header')
        <!-- Header Top END ==== -->
       
        <!-- Content -->
        @yield('content')
        <!-- Content END-->
   
        <!-- Footer ==== -->
        @yield('footer')
        <!-- Footer END ==== -->
        {{-- <button class="back-to-top fa fa-chevron-up" ></button> --}}
        <div id="cookie-popup" class="cookie-popup">
            <div class="cookie-content">
                <p>This website uses cookies to ensure you get the best experience on our website.</p>
                <div class="button-group">
                    <button onclick="acceptCookies()">Accept</button>
                    <a href="https://cpsu.edu.ph/view-sublink-content/84" target="_blank">Privacy Policy</a>
                </div>
            </div>
        </div>
        <!-- Cookie Overlay -->
        <div class="cookie-overlay"></div>
    </div>
    <!-- Chatbot Toggle Button -->
    <button class="chat-toggle" onclick="toggleChat()" title="Open CPSU ChatBot" aria-label="Open CPSU ChatBot" aria-expanded="false">
        <img src="{{ asset('Uploads/chatbot.png') }}" alt="CPSU ChatBot" aria-hidden="true">
    </button>
    <!-- Chatbot Container -->
    <div class="chat-container" id="chatContainer" role="dialog" aria-modal="true" aria-labelledby="chatHeader" aria-hidden="true">
        <div class="chat-header" id="chatHeader" onclick="toggleChat()" tabindex="0" role="button" aria-label="Close CPSU ChatBot">
            <div class="header-left">
                <img src="{{ asset('Uploads/chatbot.png') }}" alt="" aria-hidden="true">
                <span>CPSU ChatBot</span>
            </div>
            <span class="close-btn" aria-label="Close" tabindex="0" role="button">×</span>
        </div>
        <div class="chat-body" id="chatBody" role="log" aria-live="polite">
            <div class="bot-message message">
                Hi! I'm Kaloy👋 I’m your CPSU ChatBot. How can I help you today?
            </div>
        </div>
        <div class="chat-footer">
            <input
                type="text"
                id="userInput"
                placeholder="Type your message..."
                aria-label="Type your message to the chatbot"
            />
            <button onclick="sendMessage()" aria-label="Send message" id="sendBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.5 13a.5.5 0 0 1-.92.01L7.03 8.53 1.146 6.146a.5.5 0 0 1 .01-.92l13-5.5a.5.5 0 0 1 .698.42zM6.75 8.75l2.23 5.527L14.482 1.52 6.75 8.75z"/>
                </svg>
            </button>
        </div>
    </div>
    @if(request('page') !== null)
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var latestUpdatesElement = document.querySelector(".latest-updates");
            if (latestUpdatesElement) {
                latestUpdatesElement.scrollIntoView({ behavior: "smooth" });
            }
        });
    </script>
    @endif
    <!--====== FOOTER PART ENDS ======-->
   
    <!--====== BACK TO TOP PART START ======-->
    {{-- <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a> --}}
    <!--====== BACK TO TOP PART ENDS ======-->
    <!--====== jquery js ======-->
    <script src="{{ asset('js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!--====== Bootstrap js ======-->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!--====== Slick js ======-->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!--====== Magnific Popup js ======-->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!--====== Counter Up js ======-->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!--====== Nice Select js ======-->
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <!--====== Nice Number js ======-->
    <script src="{{ asset('js/jquery.nice-number.min.js') }}"></script>
    <!--====== Count Down js ======-->
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <!--====== Validator js ======-->
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <!--====== Ajax Contact js ======-->
    <script src="{{ asset('js/ajax-contact.js') }}"></script>
    <!--====== Main js ======-->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const cookiePopup = document.getElementById("cookie-popup");
        const cookieOverlay = document.querySelector(".cookie-overlay");
        // Check if the user has already accepted cookies
        if (!localStorage.getItem("cookiesAccepted")) {
            cookiePopup.classList.add("show"); // Show the popup
            cookieOverlay.style.display = "block"; // Show the overlay
        }
    });
    function acceptCookies() {
        const cookiePopup = document.getElementById("cookie-popup");
        const cookieOverlay = document.querySelector(".cookie-overlay");
        // Hide the popup and overlay
        cookiePopup.classList.remove("show");
        cookieOverlay.style.display = "none";
        // Set a flag to remember that the user accepted cookies
        localStorage.setItem("cookiesAccepted", "true");
    }
    </script>

    <!-- Active Chatbot Script (fixed syntax) -->
    <script>
    document.addEventListener("DOMContentLoaded", () => {

        /* ================= ELEMENTS ================= */
        const chatContainer = document.getElementById("chatContainer");
        const chatToggle = document.querySelector(".chat-toggle");
        const chatHeader = document.querySelector(".chat-header");
        const closeBtn = document.querySelector(".chat-header .close-btn");
        const chatBody = document.getElementById("chatBody");
        const userInput = document.getElementById("userInput");
        const sendBtn = document.getElementById("sendBtn");
        chatContainer.style.display = "none";

        /* ================= TOGGLE ================= */
        const toggleChat = () => {
            if (chatContainer.style.display === "none" || chatContainer.style.display === "") {
                chatContainer.style.display = "flex";
                chatContainer.setAttribute("aria-hidden", "false");
                chatToggle.setAttribute("aria-expanded", "true");
                chatBody.scrollTop = chatBody.scrollHeight;
            } else {
                chatContainer.style.display = "none";
                chatContainer.setAttribute("aria-hidden", "true");
                chatToggle.setAttribute("aria-expanded", "false");
            }
        };
        window.toggleChat = toggleChat;

        closeBtn.addEventListener("click", (e) => { e.stopPropagation(); toggleChat(); });
        chatHeader.addEventListener("click", e => { if(e.target !== closeBtn) toggleChat(); });

        /* ================= CONFIG ================= */
        const OPENROUTER_API_KEY = "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";
        const MODEL = "mistralai/mistral-7b-instruct:free";
        const CACHE_KEY = "cpsu_chat_history";
        const CACHE_TIME_KEY = "cpsu_chat_timestamp";
        const CACHE_KNOWLEDGE_KEY = "cpsu_chat_knowledge";
        const CACHE_KNOWLEDGE_TIME_KEY = "cpsu_chat_knowledge_time";
        const CACHE_DURATION = 4 * 60 * 60 * 1000; // 4 hours
        const FALLBACK_MESSAGE = "I do not have that information in my knowledge base.";

        let isWaiting = false;
        let conversationHistory = [];
        let activeLoadingDiv = null;
        let knowledgeCache = "";

        /* ================= CACHE ================= */
        const loadConversation = () => {
            try {
                const data = localStorage.getItem(CACHE_KEY);
                const time = +localStorage.getItem(CACHE_TIME_KEY);
                if (data && time && Date.now() - time < CACHE_DURATION)
                    return JSON.parse(data);
            } catch {}
            return [];
        };
        const saveConversation = history => {
            localStorage.setItem(CACHE_KEY, JSON.stringify(history));
            localStorage.setItem(CACHE_TIME_KEY, Date.now());
        };
        const loadKnowledge = () => {
            try {
                const data = localStorage.getItem(CACHE_KNOWLEDGE_KEY);
                const time = +localStorage.getItem(CACHE_KNOWLEDGE_TIME_KEY);
                if (data && time && Date.now() - time < CACHE_DURATION) {
                    console.log("📥 Knowledge loaded from cache.");
                    return data;
                }
            } catch {}
            return null;
        };
        const saveKnowledge = knowledge => {
            localStorage.setItem(CACHE_KNOWLEDGE_KEY, knowledge);
            localStorage.setItem(CACHE_KNOWLEDGE_TIME_KEY, Date.now());
            console.log("✅ Knowledge cached successfully.");
        };

        conversationHistory = loadConversation();
        knowledgeCache = loadKnowledge();

        /* ================= MARKDOWN ================= */
        const parseMarkdown = txt =>
            (typeof marked !== "undefined" && marked.parse)
                ? marked.parse(txt)
                : txt.replace(/\n/g, "<br>");
        const removeLoading = () => {
            if (activeLoadingDiv?.parentNode) activeLoadingDiv.parentNode.removeChild(activeLoadingDiv);
            activeLoadingDiv = null;
        };

        /* ================= FETCH KNOWLEDGE ================= */
        const fetchKnowledgeOnce = async () => {
            if (knowledgeCache) return knowledgeCache;
            const token = document.querySelector('meta[name="csrf-token"]').content;
            const res = await fetch("{{ route('chatbot-data') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": token },
                body: JSON.stringify({ input: "" })
            });
            if (!res.ok) throw new Error("Knowledge base unavailable");
            const data = await res.json();
            knowledgeCache = JSON.stringify(data.data || []);
            saveKnowledge(knowledgeCache);
            console.log("📚 Knowledge fetched from server.");
            return knowledgeCache;
        };

        /* ================= HELPER: GET RELEVANT ARTICLES ================= */
        const getRelevantArticles = (msg, max = 20) => {
            if (!knowledgeCache) return [];
            try {
                const articles = JSON.parse(knowledgeCache);
                const keyword = msg.toLowerCase().replace(/[^a-z0-9 ]/gi, '').split(' ');
                const filtered = articles.filter(a => {
                    const text = (a.title + " " + a.content).toLowerCase();
                    // match if all words in keyword exist somewhere in article
                    return keyword.every(k => text.includes(k));
                });
                filtered.sort((a,b) => new Date(b.created_at) - new Date(a.created_at));
                return filtered.slice(0, max);
            } catch {
                return [];
            }
        };

        const flattenArticles = (articles) => {
            return articles.map(a =>
                `Title: ${a.title}\nContent: ${a.content}\nURL: ${a.url}`
            ).join("\n\n");
        };

        /* ================= OPENROUTER CALL ================= */
        const callOpenRouter = async (history, question) => {
            const relevantArticles = getRelevantArticles(question, 20); // top 20 relevant
            const readableKnowledge = flattenArticles(relevantArticles);

            if (!readableKnowledge) return FALLBACK_MESSAGE;

            const messages = [
                {
                    role: "system",
                    content: `
                        You are Kaloy, a friendly CPSU ChatBot.
                        Answer only using the knowledge provided.
                        NEVER invent information outside it.
                        If unsure, reply exactly: "${FALLBACK_MESSAGE}".
                        
                        Knowledge Base:
                        ${readableKnowledge}
                    `
                },
                ...history,
                { role: "user", content: question }
            ];

            const response = await fetch("https://openrouter.ai/api/v1/chat/completions", {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${OPENROUTER_API_KEY}`,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    model: MODEL,
                    temperature: 0.7,
                    top_p: 0.95,
                    messages
                })
            });

            const data = await response.json();
            return data.choices?.[0]?.message?.content?.trim() || FALLBACK_MESSAGE;
        };

        /* ================= SEND MESSAGE ================= */
        const sendMessage = async () => {
            const msg = userInput.value.trim();
            if (!msg || isWaiting) return;

            isWaiting = true;
            sendBtn.disabled = true;
            userInput.value = "";

            // User message
            const userDiv = document.createElement("div");
            userDiv.className = "user-message message";
            userDiv.textContent = msg;
            chatBody.appendChild(userDiv);
            chatBody.scrollTop = chatBody.scrollHeight;

            // Bot typing...
            removeLoading();
            activeLoadingDiv = document.createElement("div");
            activeLoadingDiv.className = "bot-message message loading";
            activeLoadingDiv.textContent = "Kaloy is typing...";
            chatBody.appendChild(activeLoadingDiv);
            chatBody.scrollTop = chatBody.scrollHeight;

            try {
                await fetchKnowledgeOnce();

                // Local greetings/small talk
                let reply = "";
                const lowerMsg = msg.toLowerCase();
                const greetings = ["hi","hello","hey","good morning","good afternoon","good evening"];
                if (greetings.some(g => lowerMsg.includes(g))) {
                    reply = "Hi! 👋 I’m Kaloy, your CPSU ChatBot. How’s your day going?";
                } else if (/how are you/.test(lowerMsg)) {
                    reply = "I’m just a chatbot 🤖, but I’m happy to chat with you! How are you today?";
                } else {
                    // Knowledge-based response
                    reply = await callOpenRouter(conversationHistory, msg);
                }

                // simulate typing delay
                await new Promise(res => setTimeout(res, 500 + Math.random() * 800));

                removeLoading();
                const botDiv = document.createElement("div");
                botDiv.className = "bot-message message";
                botDiv.innerHTML = parseMarkdown(reply);
                chatBody.appendChild(botDiv);
                chatBody.scrollTop = chatBody.scrollHeight;

                conversationHistory.push(
                    { role: "user", content: msg },
                    { role: "assistant", content: reply }
                );
                saveConversation(conversationHistory);

            } catch (err) {
                removeLoading();
                const errDiv = document.createElement("div");
                errDiv.className = "bot-message message";
                errDiv.textContent = "❌ Unable to retrieve information right now.";
                chatBody.appendChild(errDiv);
            } finally {
                isWaiting = false;
                sendBtn.disabled = false;
            }
        };

        userInput?.addEventListener("keypress", e => { if (e.key === "Enter") { e.preventDefault(); sendMessage(); } });
        sendBtn?.addEventListener("click", sendMessage);

        /* ================= REFRESH KNOWLEDGE EVERY 4 HOURS ================= */
        setInterval(async () => {
            const lastFetchTime = +localStorage.getItem(CACHE_KNOWLEDGE_TIME_KEY) || 0;
            if (Date.now() - lastFetchTime >= CACHE_DURATION) {
                console.log("⏳ Knowledge cache expired, refreshing...");
                try { await fetchKnowledgeOnce(); } catch(e) { console.warn("⚠️ Failed to refresh knowledge:", e); }
            }
        }, 5 * 60 * 1000);

    });
    </script>
</body>
</html>