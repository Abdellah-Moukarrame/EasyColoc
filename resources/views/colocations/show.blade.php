<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CoLoc — Appartement Voltaire</title>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Nunito:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #FDF8F2;
        }

        .serif {
            font-family: 'DM Serif Display', serif;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatY {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes popIn {
            0% {
                opacity: 0;
                transform: scale(.85);
            }

            70% {
                transform: scale(1.04);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-10px) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(60px) rotate(360deg);
                opacity: 0;
            }
        }

        .fu {
            animation: fadeUp .5s ease both;
        }

        .fu1 {
            animation: fadeUp .5s .08s ease both;
        }

        .fu2 {
            animation: fadeUp .5s .16s ease both;
        }

        .fu3 {
            animation: fadeUp .5s .24s ease both;
        }

        .fu4 {
            animation: fadeUp .5s .32s ease both;
        }

        .float {
            animation: floatY 5s ease-in-out infinite;
        }

        /* step cards */
        .step-card {
            background: white;
            border: 1.5px solid rgba(0, 0, 0, .07);
            border-radius: 20px;
            padding: 1.75rem;
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }

        .step-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 36px rgba(0, 0, 0, .08);
            border-color: #D97706;
        }

        /* tab system */
        .tab-btn {
            transition: all .2s;
        }

        .tab-btn.active {
            background: #1C1917;
            color: white;
        }

        /* success toast */
        .toast {
            animation: popIn .4s ease both;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: #D4C9BB;
            border-radius: 4px;
        }

        /* modal */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            backdrop-filter: blur(6px);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-card {
            background: white;
            border-radius: 28px;
            width: 100%;
            max-width: 480px;
            padding: 2.5rem;
            position: relative;
            animation: fadeUp .3s ease;
        }

        /* confetti dots */
        .confetti span {
            position: absolute;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            animation: confetti-fall 1.4s ease forwards;
        }
    </style>
</head>

<body>

    <!-- ═══════════════════ SIDEBAR ═══════════════════ -->
    <aside class="w-64 bg-[#1C1917] flex flex-col min-h-screen fixed left-0 top-0 z-30">

        <div class="px-6 pt-7 pb-6 border-b border-white/10">
            <a href="/dashboard" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-500 flex items-center justify-center">
                    <span class="serif text-white text-xl font-bold">C</span>
                </div>
                <span class="serif text-amber-400 text-xl">CoLoc</span>
            </a>
        </div>

        <nav class="flex-1 py-5 px-3 space-y-1">

            <a href="/dashboard"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10h14V10" />
                </svg>
                Tableau de bord
            </a>

            <a href="{{ route('colocation.show', ['{id}', $collocation->id]) }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold bg-amber-500 text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 22V12h6v10" />
                </svg>
                Ma Colocation
            </a>

            <a href="{{ route('depences.index', ['id' => $collocation->id]) }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                </svg>
                Dépenses
            </a>

            <!-- Owner-only section -->
            @if (auth()->user()->id == $owner->id)
                <div class="pt-3 mt-3 border-t border-white/10 space-y-1">
                    <p class="px-3 text-xs text-gray-600 font-bold uppercase tracking-widest mb-2">Owner</p>

                    <a href="/colocations/1/invite"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Inviter des membres
                        <!-- New badge -->
                        <span
                            class="ml-auto bg-amber-500 text-white text-xs px-1.5 py-0.5 rounded-full font-bold">!</span>
                    </a>

                    <a href="/categories"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z" />
                        </svg>
                        Catégories
                    </a>

                    <a href="/colocations/1/edit"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        Gérer la colocation
                    </a>

                </div>
            @endif


        </nav>

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div
                    class="w-9 h-9 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold text-sm">
                    {{ substr(auth()->user()->name, 0, 2) }}</div>
                <div class="min-w-0">
                    <div class="text-white text-sm font-semibold truncate">{{ auth()->user()->name }}</div>
                    <div class="text-amber-400 text-xs font-semibold">You</div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="ml-auto text-gray-600 hover:text-red-400 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>


    <!-- ═══════════════════ MAIN ═══════════════════ -->
    <main class="ml-64 p-8 min-h-screen">

        <!-- ── Hero banner ── -->
        <div
            class="fu relative rounded-2xl overflow-hidden bg-gradient-to-br from-[#1C1917] via-[#2C2926] to-[#3C3530] p-8 mb-7">
            <div class="absolute -top-10 -right-10 w-52 h-52 bg-amber-500 opacity-15 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 w-36 h-36 bg-amber-700 opacity-10 rounded-full blur-xl"></div>

            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <h1 class="serif text-4xl text-white mb-1">{{ $collocation->name }}</h1>
                    <p class="text-gray-400 text-sm">Votre colocation vient d'être créée — invitez vos colocataires
                        pour commencer !</p>
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-2">
                    <button onclick="document.getElementById('modal-invite').classList.remove('hidden')"
                        class="flex items-center gap-2 bg-amber-500 hover:bg-amber-400 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8" />
                        </svg>
                        Inviter des membres
                    </button>
                    <button onclick="document.getElementById('modal-expense').classList.remove('hidden')"
                        class="flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajouter une dépense
                    </button>
                </div>
            </div>
        </div>

        <!-- ── Tabs ── -->
        <div class="fu1 flex gap-2 mb-7">
            <button onclick="showTab('membres')" id="tab-membres"
                class="tab-btn active px-5 py-2 rounded-xl text-sm font-bold border border-transparent transition">
                Membres <span class="ml-1 bg-white/20 text-xs px-1.5 py-0.5 rounded-full">1</span>
            </button>
            <button onclick="showTab('depenses')" id="tab-depenses"
                class="tab-btn px-5 py-2 rounded-xl text-sm font-bold bg-white border border-gray-200 text-gray-500 transition">
                Dépenses <span class="ml-1 bg-gray-100 text-gray-400 text-xs px-1.5 py-0.5 rounded-full">0</span>
            </button>
            <button onclick="showTab('balances')" id="tab-balances"
                class="tab-btn px-5 py-2 rounded-xl text-sm font-bold bg-white border border-gray-200 text-gray-500 transition">
                Balances
            </button>
            <button onclick="showTab('categories')" id="tab-categories"
                class="tab-btn px-5 py-2 rounded-xl text-sm font-bold bg-white border border-gray-200 text-gray-500 transition">
                Catégories
            </button>
        </div>


        <!-- ════════ TAB: Membres ════════ -->
        <div id="pane-membres">
            <div class="fu2 grid grid-cols-3 gap-6">

                <!-- Left col: Members list -->
                <div class="col-span-1 space-y-4">

                    <!-- Owner card -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-5">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Membres actifs</p>
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <div
                                    class="w-12 h-12 rounded-full bg-amber-500 text-white font-bold text-lg flex items-center justify-center">
                                    {{ substr($owner->name, 0, 2) }}</div>
                                <div
                                    class="absolute -bottom-0.5 -right-0.5 w-5 h-5 bg-amber-400 rounded-full border-2 border-white flex items-center justify-center">
                                    <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="font-bold text-[#1C1917]">{{ $owner->name }}</p>
                                <p class="text-xs text-gray-400">{{ $owner->email }}</p>
                            </div>
                            <span
                                class="ml-auto bg-amber-100 text-amber-700 text-xs px-2.5 py-1 rounded-full font-bold">Owner</span>
                        </div>

                        <!-- Separator with empty slots -->
                        <div class="mt-5 pt-4 border-t border-dashed border-gray-200">
                            <p class="text-xs text-gray-400 mb-3">En attente de membres…</p>
                            <div class="space-y-2">
                                @foreach ($members as $member)
                                    <div class="flex items-center gap-3 py-2">
                                        <div
                                            class="w-9 h-9 rounded-full border-2 border-dashed border-gray-200 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-300" fill="none"
                                                viewBox="0 0 24 24"stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </div>
                                        <p class="text-xs text-gray-300 italic"> {{ $member->user->name }}</p>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>

                    <!-- Invite CTA card -->
                    @if (auth()->user()->id == $owner->id)
                        <div class="bg-[#1C1917] rounded-2xl p-5 relative overflow-hidden">
                            <div
                                class="absolute -top-6 -right-6 w-24 h-24 bg-amber-500 opacity-15 rounded-full blur-xl">
                            </div>
                            <div class="relative z-10">
                                <p class="text-amber-400 font-bold text-sm mb-1">Vous êtes seul pour l'instant !</p>
                                <p class="text-gray-400 text-xs leading-relaxed mb-4">Invitez vos colocataires par
                                    email
                                    pour commencer à partager les dépenses.</p>
                                <button onclick="document.getElementById('modal-invite').classList.remove('hidden')"
                                    class="w-full bg-amber-500 hover:bg-amber-400 text-white text-sm font-bold py-2.5 rounded-xl transition flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8" />
                                    </svg>
                                    Envoyer une invitation
                                </button>
                            </div>
                        </div>
                    @endif


                </div>

                <!-- Right col: Next steps -->
                <div class="col-span-2">

                    <!-- Checklist: getting started -->
                    <div class="fu3 bg-white rounded-2xl border border-gray-100 p-6 mb-5">
                        <div class="flex items-center gap-3 mb-5">
                            <div
                                class="w-9 h-9 rounded-xl bg-amber-100 flex items-center justify-center text-xl flex-shrink-0">
                                🚀</div>
                            <div>
                                <h3 class="serif text-lg text-[#1C1917]">Bien démarrer votre colocation</h3>
                                <p class="text-xs text-gray-400">Complétez ces étapes pour profiter pleinement de
                                    CoLoc.</p>
                            </div>
                            <!-- Progress -->
                            <div class="ml-auto text-right">
                                <p class="text-xs text-gray-400 mb-1">1 / 4 complétées</p>
                                <div class="w-24 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-amber-500 rounded-full" style="width:25%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">

                            <!-- Step 1 — done -->
                            <div
                                class="flex items-center gap-4 p-4 bg-emerald-50 border border-emerald-100 rounded-xl">
                                <div
                                    class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-emerald-800 line-through opacity-60">Créer votre
                                        colocation</p>
                                    <p class="text-xs text-emerald-600">Fait aujourd'hui ✓</p>
                                </div>
                            </div>

                            <!-- Step 2 — active -->
                            <div
                                class="flex items-center gap-4 p-4 bg-amber-50 border-2 border-amber-300 rounded-xl relative overflow-hidden">
                                <div
                                    class="absolute right-3 top-3 text-xs text-amber-500 font-bold uppercase tracking-wider animate-pulse">
                                    Maintenant</div>
                                <div
                                    class="w-8 h-8 rounded-full bg-amber-500 flex items-center justify-center flex-shrink-0 text-white font-bold text-sm serif">
                                    2</div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-[#1C1917]">Inviter vos colocataires</p>
                                    <p class="text-xs text-gray-500">Envoyez des invitations par email. Chaque membre
                                        rejoint en un clic.</p>
                                </div>
                                <button onclick="document.getElementById('modal-invite').classList.remove('hidden')"
                                    class="bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold px-3 py-2 rounded-xl transition flex-shrink-0">
                                    Inviter →
                                </button>
                            </div>

                            <!-- Step 3 -->
                            <div
                                class="flex items-center gap-4 p-4 bg-gray-50 border border-gray-100 rounded-xl opacity-60">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center flex-shrink-0 text-gray-500 font-bold text-sm serif">
                                    3</div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-gray-500">Ajouter vos premières dépenses</p>
                                    <p class="text-xs text-gray-400">Loyer, courses, factures… enregistrez tout ce que
                                        vous partagez.</p>
                                </div>
                                <div class="w-8 h-8 rounded-full border-2 border-dashed border-gray-300 flex-shrink-0">
                                </div>
                            </div>

                            <!-- Step 4 -->
                            <div
                                class="flex items-center gap-4 p-4 bg-gray-50 border border-gray-100 rounded-xl opacity-60">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center flex-shrink-0 text-gray-500 font-bold text-sm serif">
                                    4</div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-gray-500">Consulter les balances et régler</p>
                                    <p class="text-xs text-gray-400">CoLoc calcule automatiquement qui doit quoi à qui.
                                    </p>
                                </div>
                                <div class="w-8 h-8 rounded-full border-2 border-dashed border-gray-300 flex-shrink-0">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- ════════ TAB: Dépenses ════════ -->
        <div id="pane-depenses" class="hidden">
            <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center">
                <div
                    class="float w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center text-3xl mx-auto mb-5">
                    📋</div>
                <h3 class="serif text-2xl text-[#1C1917] mb-2">Aucune dépense pour l'instant</h3>
                <p class="text-gray-400 text-sm max-w-xs mx-auto mb-7 leading-relaxed">
                    Ajoutez votre première dépense partagée — loyer, courses, factures — et CoLoc calculera les soldes
                    automatiquement.
                </p>
                <button onclick="document.getElementById('modal-expense').classList.remove('hidden')"
                    class="bg-[#1C1917] hover:bg-amber-500 text-white px-6 py-3 rounded-xl text-sm font-bold transition inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Ajouter une dépense
                </button>
            </div>
        </div>


        <!-- ════════ TAB: Balances ════════ -->
        <div id="pane-balances" class="hidden">
            <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center">
                <div
                    class="float w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center text-3xl mx-auto mb-5">
                    ⚖️</div>
                <h3 class="serif text-2xl text-[#1C1917] mb-2">Tout le monde est à zéro</h3>
                <p class="text-gray-400 text-sm max-w-xs mx-auto leading-relaxed">
                    Les balances apparaîtront ici dès que vous aurez ajouté des dépenses et des membres.
                </p>
            </div>
        </div>


        <!-- ════════ TAB: Catégories ════════ -->

        @if (auth()->user()->memberships()->where([
                    'type' => 'owner',
                ])->exists())
            <div id="pane-categories" class="">
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="serif text-lg text-[#1C1917]">Catégories</h3>
                        <button onclick="document.getElementById('modal-category').classList.remove('hidden')"
                            class="flex items-center gap-2 bg-[#1C1917] hover:bg-amber-600 text-white text-sm font-bold px-4 py-2 rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Nouvelle catégorie
                        </button>
                    </div>

                    <div class="space-y-2">
                        @foreach ($categories as $category)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                <span class="text-sm font-semibold">{{ $category->name }}</span>

                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>


            <!-- ═══════════════════ MODAL: Nouvelle catégorie ═══════════════════ -->
            <div id="modal-category"
                class="hidden fixed inset-0 bg-black/45 backdrop-blur-sm z-50 flex items-center justify-center">

                <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative">

                    <!-- Close -->
                    <button onclick="document.getElementById('modal-category').classList.add('hidden')"
                        class="absolute right-5 top-5 text-gray-300 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Header -->
                    <div class="flex items-center gap-4 mb-7">
                        <div
                            class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center text-2xl flex-shrink-0">
                            🏷️
                        </div>
                        <div>
                            <h3 class="serif text-2xl text-[#1C1917]">Nouvelle catégorie</h3>
                            <p class="text-xs text-gray-400">Disponible pour toutes les dépenses de la colocation.
                            </p>
                        </div>
                    </div>

                    <!-- Form -->

                    <form action="{{ route('category') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="colocation_id" value="{{ $collocation->id }}">
                        <div>
                            <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">
                                Nom de la catégorie <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="name" placeholder="Ex: 🚗 Transport" required
                                minlength="2"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none transition" />
                            <p class="text-xs text-gray-400 mt-1.5">Conseil : ajoutez un emoji devant pour mieux
                                identifier
                                la catégorie.</p>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button"
                                onclick="document.getElementById('modal-category').classList.add('hidden')"
                                class="flex-1 border border-gray-200 text-gray-600 py-3 rounded-xl text-sm font-semibold hover:bg-gray-50 transition">
                                Annuler
                            </button>
                            <button type="submit"
                                class="flex-1 bg-[#1C1917] hover:bg-amber-600 text-white py-3 rounded-xl text-sm font-bold transition">
                                Ajouter →
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        @endif
        <!-- ════════ TAB: Balances ════════ -->
        <div id="pane-balances" class="">
            @if ($statements->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center">
                    <div
                        class="float w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center text-3xl mx-auto mb-5">
                        ⚖️</div>
                    <h3 class="serif text-2xl text-[#1C1917] mb-2">Tout le monde est à zéro</h3>
                    <p class="text-gray-400 text-sm max-w-xs mx-auto leading-relaxed">
                        Les balances apparaîtront ici dès que vous aurez ajouté des dépenses.
                    </p>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="serif text-lg text-[#1C1917]">Qui doit quoi à qui ?</h3>
                        <span class="text-xs text-gray-400 font-semibold">{{ $statements->count() }} règlement(s) en
                            attente</span>
                    </div>

                    <div class="divide-y divide-gray-50">
                        @foreach ($statements as $statement)
                            <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50/50 transition">

                                <div class="flex items-center gap-2 min-w-0">
                                    <div
                                        class="w-9 h-9 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($statement->user->name, 0, 1)) }}
                                    </div>
                                    <span
                                        class="text-sm font-semibold text-[#1C1917] truncate">{{ $statement->user->name }}</span>
                                </div>

                                <div class="flex items-center gap-1 text-gray-300 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </div>


                                <div class="flex items-center gap-2 flex-1 min-w-0">
                                    <div
                                        class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($statement->receiver->name, 0, 1)) }}
                                    </div>
                                    <span
                                        class="text-sm font-semibold text-[#1C1917] truncate">{{ $statement->receiver->name }}</span>
                                </div>


                                <div class="text-right flex-shrink-0">
                                    <span
                                        class="text-sm font-bold text-red-500">{{ number_format($statement->amount_to_pay, 2) }}
                                        €</span>
                                    <p class="text-xs text-gray-400">{{ $statement->depence->name }}</p>
                                </div>


                                @if (auth()->id() == $statement->user_id)
                                    <form action="{{ route('statement.paid', $statement->id) }}" method="POST"
                                        class="flex-shrink-0">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold px-3 py-2 rounded-xl transition">
                                            ✓ Marquer payé
                                        </button>
                                    </form>
                                @else
                                    <span
                                        class="text-xs text-amber-500 font-semibold bg-amber-50 px-3 py-2 rounded-xl flex-shrink-0">En
                                        attente</span>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>




    </main>


    <!-- ═══════════════════ MODAL: Inviter ═══════════════════ -->
    @if (auth()->user()->memberships()->where([
                'type' => 'owner',
            ])->exists())
        <div id="modal-invite" class="modal-backdrop hidden">
            <div class="modal-card">
                <button onclick="document.getElementById('modal-invite').classList.add('hidden')"
                    class="absolute right-5 top-5 text-gray-300 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="flex items-center gap-4 mb-7">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="serif text-2xl text-[#1C1917]">Inviter un colocataire</h3>
                        <p class="text-xs text-gray-400">Un email avec un lien d'invitation sera envoyé.</p>
                    </div>
                </div>

                <form action="{{ route('send_invitation') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="colocation_id" value="{{ $collocation->id }}">
                    <div>
                        <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">
                            Adresse email <span class="text-red-400">*</span>
                        </label>
                        <input type="email" name="email" placeholder="colocataire@exemple.fr"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none" />
                    </div>

                    <div
                        class="bg-[#FDF8F2] border border-gray-100 rounded-xl p-4 text-xs text-gray-500 leading-relaxed">
                        📌 Le lien d'invitation est valable <strong>48 heures</strong>. L'invité doit avoir un compte
                        CoLoc
                        avec le même email.
                    </div>

                    <div class="flex gap-3">
                        <button type="button"
                            onclick="document.getElementById('modal-invite').classList.add('hidden')"
                            class="flex-1 border border-gray-200 text-gray-600 py-3 rounded-xl text-sm font-semibold hover:bg-gray-50 transition">
                            Annuler
                        </button>
                        <button type="submit"
                            class="flex-1 bg-amber-500 hover:bg-amber-400 text-white py-3 rounded-xl text-sm font-bold transition">
                            Envoyer l'invitation →
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif



    <!-- ═══════════════════ MODAL: Ajouter dépense ═══════════════════ -->
    <div id="modal-expense" class="modal-backdrop hidden">
        <div class="modal-card">
            <button onclick="document.getElementById('modal-expense').classList.add('hidden')"
                class="absolute right-5 top-5 text-gray-300 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="flex items-center gap-4 mb-7">
                <div class="w-12 h-12 rounded-2xl bg-[#1C1917] flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div>
                    <h3 class="serif text-2xl text-[#1C1917]">Nouvelle dépense</h3>
                    <p class="text-xs text-gray-400">Sera répartie entre tous les membres actifs.</p>
                </div>
            </div>

            <form action="{{ route('depences.add') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="colocation_id" value="{{ $collocation->id }}">
                <div>
                    <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Titre <span
                            class="text-red-400">*</span></label>
                    <input type="text" name="name" placeholder="Ex: Loyer Février"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Montant (€) <span
                                class="text-red-400">*</span></label>
                        <input type="number" name="amount" step="0.01" placeholder="0.00"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Date <span
                                class="text-red-400">*</span></label>
                        <input type="date" name="date" value="2026-02-23"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none" />
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Catégorie</label>
                    <select name="category_id"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                        <option value="">Sélectionner…</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach


                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Payé par</label>
                    <select name="paid_by"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none">
                        <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->user_id }}">{{ $member->user->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-400 mt-1">D'autres membres apparaîtront ici une fois qu'ils auront
                        rejoint.</p>
                </div>
                <div class="flex gap-3 pt-1">
                    <button type="button" onclick="document.getElementById('modal-expense').classList.add('hidden')"
                        class="flex-1 border border-gray-200 text-gray-600 py-3 rounded-xl text-sm font-semibold hover:bg-gray-50 transition">
                        Annuler
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#1C1917] hover:bg-amber-500 text-white py-3 rounded-xl text-sm font-bold transition">
                        Enregistrer →
                    </button>
                </div>
            </form>
        </div>
    </div>



    <script>
        /* Tabs */
        //   function showTab(name) {
        //     ['membres','depenses','balances','categories'].forEach(t => {
        //       document.getElementById('pane-'+t).classList.add('hidden');
        //       const btn = document.getElementById('tab-'+t);
        //       btn.classList.remove('active');
        //       btn.classList.add('bg-white','border-gray-200','text-gray-500');
        //     });
        //     document.getElementById('pane-'+name).classList.remove('hidden');
        //     const active = document.getElementById('tab-'+name);
        //     active.classList.add('active');
        //     active.classList.remove('bg-white','border-gray-200','text-gray-500');
        //   }

        /* Auto-hide toast after 4s */
        //   setTimeout(() => {
        //     const toast = document.getElementById('success-toast');
        //     if (toast) toast.style.opacity = '0', toast.style.transition = 'opacity .5s', setTimeout(()=>toast.remove(),500);
        //   }, 4000);
    </script>

</body>

</html>
