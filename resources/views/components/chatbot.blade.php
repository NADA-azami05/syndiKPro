{{-- ═══════════════════════════════════════
    CHATBOT ASSISTANT SYNDICPRO
    Fichier : resources/views/components/chatbot.blade.php
═══════════════════════════════════════ --}}

{{-- Bouton flottant --}}
<div style="position:fixed;bottom:24px;right:24px;z-index:9999;">
  <button onclick="toggleChat()"
    style="width:56px;height:56px;border-radius:50%;
           background:white;border:2px solid #006AD7;
           cursor:pointer;padding:5px;
           box-shadow:0 4px 16px rgba(0,106,215,0.4);
           display:flex;align-items:center;justify-content:center;">
    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:44px;height:44px;">
      <ellipse cx="32" cy="36" rx="20" ry="18" fill="white" stroke="#006AD7" stroke-width="2"/>
      <rect x="17" y="28" width="30" height="14" rx="7" fill="#006AD7"/>
      <rect x="20" y="31" width="7" height="8" rx="2" fill="white"/>
      <rect x="37" y="31" width="7" height="8" rx="2" fill="white"/>
      <line x1="32" y1="16" x2="32" y2="22" stroke="#006AD7" stroke-width="2.5" stroke-linecap="round"/>
      <circle cx="32" cy="13" r="3.5" fill="#006AD7"/>
      <ellipse cx="12" cy="36" rx="4.5" ry="6.5" fill="#006AD7"/>
      <ellipse cx="52" cy="36" rx="4.5" ry="6.5" fill="#006AD7"/>
      <path d="M12 30 Q32 16 52 30" stroke="#006AD7" stroke-width="2.5" fill="none" stroke-linecap="round"/>
      <path d="M43 48 Q50 52 48 58" stroke="#006AD7" stroke-width="2" fill="none" stroke-linecap="round"/>
      <circle cx="48" cy="59" r="2" fill="#006AD7"/>
    </svg>
  </button>
</div>

{{-- Fenêtre chat — position fixed indépendante du bouton --}}
<div id="chat-box"
  style="display:none;
         position:fixed;
         bottom:90px;
         right:24px;
         width:320px;
         height:460px;
         background:#ffffff;
         border-radius:14px;
         box-shadow:0 8px 40px rgba(0,0,0,0.13);
         flex-direction:column;
         border:1.5px solid #006AD7;
         overflow:hidden;
         z-index:9998;">

  {{-- Header (une seule fois) --}}
  <div style="background:#006AD7;padding:13px 16px;
              color:white;display:flex;align-items:center;
              justify-content:space-between;flex-shrink:0;">
    <div style="display:flex;align-items:center;gap:9px;">

      {{-- Logo robot SVG --}}
      <div style="width:36px;height:36px;background:white;
                  border-radius:50%;
                  display:flex;align-items:center;justify-content:center;
                  box-shadow:0 2px 6px rgba(0,0,0,0.15);flex-shrink:0;">
        <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:30px;height:30px;">
          <ellipse cx="32" cy="36" rx="20" ry="18" fill="white" stroke="#006AD7" stroke-width="2"/>
          <rect x="17" y="28" width="30" height="14" rx="7" fill="#006AD7"/>
          <rect x="20" y="31" width="7" height="8" rx="2" fill="white"/>
          <rect x="37" y="31" width="7" height="8" rx="2" fill="white"/>
          <line x1="32" y1="16" x2="32" y2="22" stroke="#006AD7" stroke-width="2.5" stroke-linecap="round"/>
          <circle cx="32" cy="13" r="3.5" fill="#006AD7"/>
          <ellipse cx="12" cy="36" rx="4.5" ry="6.5" fill="#006AD7"/>
          <ellipse cx="52" cy="36" rx="4.5" ry="6.5" fill="#006AD7"/>
          <path d="M12 30 Q32 16 52 30" stroke="#006AD7" stroke-width="2.5" fill="none" stroke-linecap="round"/>
          <path d="M43 48 Q50 52 48 58" stroke="#006AD7" stroke-width="2" fill="none" stroke-linecap="round"/>
          <circle cx="48" cy="59" r="2" fill="#006AD7"/>
        </svg>
      </div>

      <div>
        <div style="font-weight:600;font-size:14px;font-family:'DM Sans',sans-serif;">
          Assistant SyndicPro
        </div>
        <div style="font-size:11px;opacity:.85;font-family:'DM Sans',sans-serif;">
          ● En ligne
        </div>
      </div>
    </div>

    <button onclick="toggleChat()"
      style="background:none;border:none;color:white;
             cursor:pointer;font-size:18px;opacity:.8;
             padding:0;line-height:1;">✕</button>
  </div>

  {{-- Zone messages --}}
  <div id="chat-messages"
    style="flex:1;overflow-y:auto;padding:14px 12px;
           display:flex;flex-direction:column;gap:10px;
           background:#f0f4ff;">
  </div>

  {{-- Zone saisie --}}
  <div style="padding:10px;border-top:1.5px solid #e5e7eb;
              background:white;display:flex;gap:7px;
              align-items:center;flex-shrink:0;">
    <input id="chat-input" placeholder="Votre question..."
      onkeydown="if(event.key==='Enter') envoyerMessage()"
      style="flex:1;padding:9px 12px;
             border:1.5px solid #e5e7eb;border-radius:9px;
             font-size:13px;outline:none;
             font-family:'DM Sans',sans-serif;
             background:#f9fafb;transition:border-color .2s;"
      onfocus="this.style.borderColor='#006AD7'"
      onblur="this.style.borderColor='#e5e7eb'"/>
    <button onclick="envoyerMessage()" id="send-btn"
      style="width:38px;height:38px;background:#006AD7;
             color:white;border:none;border-radius:9px;
             cursor:pointer;font-size:16px;display:flex;
             align-items:center;justify-content:center;
             flex-shrink:0;transition:background .2s;"
      onmouseover="this.style.background='#0055b3'"
      onmouseout="this.style.background='#006AD7'">
      →
    </button>
  </div>

</div>

<script>
// Bienvenue affiché une seule fois par session
let bienvenuAffiche = sessionStorage.getItem('chatbot_bienvenu') === 'true';
let chatOuvert = false;

function toggleChat() {
  const box = document.getElementById('chat-box');
  chatOuvert = !chatOuvert;
  box.style.display = chatOuvert ? 'flex' : 'none';

  if (chatOuvert && !bienvenuAffiche) {
    ajouterBulle('Bonjour {{ auth()->user()->name }} ! Je suis votre assistant SyndicPro. Comment puis-je vous aider ?', 'bot');
    bienvenuAffiche = true;
    sessionStorage.setItem('chatbot_bienvenu', 'true');
  }

  if (chatOuvert) {
    setTimeout(() => document.getElementById('chat-input').focus(), 100);
  }
}

function ajouterBulle(texte, role) {
  const div = document.getElementById('chat-messages');
  const wrapper = document.createElement('div');
  wrapper.style.cssText = `display:flex;flex-direction:column;align-items:${role === 'user' ? 'flex-end' : 'flex-start'}`;

  const bulle = document.createElement('div');
  bulle.style.cssText = role === 'user'
    ? 'background:#006AD7;color:white;padding:9px 13px;border-radius:14px 14px 4px 14px;font-size:13px;max-width:82%;line-height:1.55;word-break:break-word;font-family:"DM Sans",sans-serif;box-shadow:0 2px 8px rgba(0,106,215,0.2)'
    : 'background:white;color:#111;padding:9px 13px;border-radius:14px 14px 14px 4px;font-size:13px;max-width:82%;line-height:1.55;word-break:break-word;font-family:"DM Sans",sans-serif;box-shadow:0 2px 8px rgba(0,0,0,0.07);border:1px solid #e5e7eb';

  // Convertir **gras** en <strong>
  bulle.innerHTML = texte.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
  wrapper.appendChild(bulle);
  div.appendChild(wrapper);
  div.scrollTop = div.scrollHeight;
  return bulle;
}

async function envoyerMessage() {
  const input = document.getElementById('chat-input');
  const btn   = document.getElementById('send-btn');
  const texte = input.value.trim();
  if (!texte) return;

  input.value   = '';
  input.disabled = true;
  btn.disabled   = true;
  btn.textContent = '…';

  ajouterBulle(texte, 'user');

  // Bulle de chargement
  const div = document.getElementById('chat-messages');
  const loading = document.createElement('div');
  loading.style.cssText = 'display:flex;align-items:flex-start;';
  loading.innerHTML = `
    <div id="loading-bulle" style="background:white;border:1px solid #e5e7eb;
         padding:9px 13px;border-radius:14px 14px 14px 4px;font-size:13px;
         color:#6b7280;font-family:'DM Sans',sans-serif;
         box-shadow:0 2px 8px rgba(0,0,0,0.07)">
      <span id="typing-dots">● ● ●</span>
    </div>`;
  div.appendChild(loading);
  div.scrollTop = div.scrollHeight;

  let dots = 0;
  const dotAnim = setInterval(() => {
    dots = (dots + 1) % 4;
    const el = document.getElementById('typing-dots');
    if (el) el.textContent = ['● ● ●','○ ● ●','● ○ ●','● ● ○'][dots];
  }, 400);

  try {
    const res = await fetch('{{ route("chatbot.send") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ message: texte })
    });
    const data = await res.json();
    clearInterval(dotAnim);
    if (div.contains(loading)) div.removeChild(loading);
    ajouterBulle(data.reply ?? 'Désolé, une erreur est survenue.', 'bot');
  } catch (e) {
    clearInterval(dotAnim);
    if (div.contains(loading)) div.removeChild(loading);
    ajouterBulle('Erreur de connexion. Réessayez.', 'bot');
  } finally {
    input.disabled  = false;
    btn.disabled    = false;
    btn.textContent = '→';
    input.focus();
  }
}
</script>