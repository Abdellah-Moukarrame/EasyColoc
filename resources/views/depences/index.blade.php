<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CoLoc — Dépenses</title>
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

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: #D4C9BB;
            border-radius: 4px;
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
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-400 hover:text-white hover:bg-white/10 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 22V12h6v10" />
                </svg>
                Ma Colocation
            </a>
            <a href="{{ route('depences.index', ['id' => $collocation->id]) }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold bg-amber-500 text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                </svg>
                Dépenses
            </a>

        </nav>

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div
                    class="w-9 h-9 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold text-sm">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
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

        <!-- ── Header ── -->
        <div class="fu flex items-center justify-between mb-7">
            <div>
                <h1 class="serif text-3xl text-[#1C1917]">Dépenses</h1>
                <p class="text-sm text-gray-400 mt-1">Toutes les dépenses de <span
                        class="font-semibold text-[#1C1917]">{{ $collocation->name }}</span></p>
            </div>
            <button onclick="document.getElementById('modal-expense').classList.remove('hidden')"
                class="flex items-center gap-2 bg-[#1C1917] hover:bg-amber-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nouvelle dépense
            </button>
            @if (auth()->user()->id != $owner->id)
                <form action="{{ route('membership.quitter') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="colocation_id" value="{{ $collocation->id }}">
                    <button type="submit"
                        class="flex items-center gap-2 border border-red-200 text-red-400 hover:bg-red-50 px-4 py-2 rounded-xl text-sm font-semibold transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                        </svg>
                        Quitter la colocation
                    </button>
                </form>
            @endif
        </div>

        <!-- ── Stats row ── -->
        <div class="fu1 grid grid-cols-3 gap-5 mb-7">
            <div class="bg-white rounded-2xl border border-gray-100 p-5">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Total dépenses</p>
                <p class="serif text-3xl text-[#1C1917]">{{ number_format($depences->sum('amount'), 2) }} Dh</p>
                <p class="text-xs text-gray-400 mt-1">{{ $depences->count() }} dépense(s)</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-5">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Votre part</p>
                <p class="serif text-3xl text-amber-500">
                    {{ number_format($depences->sum('amount') / max($membersCount, 1), 2) }} Dh</p>
                <p class="text-xs text-gray-400 mt-1">Répartie sur {{ $membersCount }} membre(s)</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-5">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Ce mois-ci</p>
                <p class="serif text-3xl text-[#1C1917]">
                    {{ number_format($depences->where('created_at', '>=', now()->startOfMonth())->sum('amount'), 2) }}
                    Dh</p>
                <p class="text-xs text-gray-400 mt-1">{{ now()->translatedFormat('F Y') }}</p>
            </div>
        </div>

        <!-- ── Depenses list ── -->
        <div class="fu2 bg-white rounded-2xl border border-gray-100 overflow-hidden">

            <!-- Table header -->
            <div
                class="grid grid-cols-12 gap-4 px-6 py-3 bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-400 uppercase tracking-widest">
                <div class="col-span-4">Titre</div>
                <div class="col-span-2">Catégorie</div>
                <div class="col-span-2">Payé par</div>
                <div class="col-span-2">Date</div>
                <div class="col-span-1 text-right">Montant</div>
                <div class="col-span-1"></div>
            </div>

            <!-- Rows -->
            @forelse ($depences as $depence)
                <div
                    class="grid grid-cols-12 gap-4 px-6 py-4 border-b border-gray-50 hover:bg-gray-50/50 transition items-center">

                    <!-- Title -->
                    <div class="col-span-4 flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-amber-100 flex items-center justify-center text-lg flex-shrink-0">
                            💸
                        </div>
                        <div>
                            <p class="text-sm font-bold text-[#1C1917]">{{ $depence->name }}</p>
                            <p class="text-xs text-gray-400">{{ $depence->statements->count() }} membre(s) concerné(s)
                            </p>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="col-span-2">
                        @if ($depence->category)
                            <span class="bg-amber-100 text-amber-700 text-xs px-2.5 py-1 rounded-full font-semibold">
                                {{ $depence->category->name }}
                            </span>
                        @else
                            <span class="text-gray-300 text-xs">—</span>
                        @endif
                    </div>

                    <!-- Paid by -->
                    <div class="col-span-2 flex items-center gap-2">
                        <div
                            class="w-7 h-7 rounded-full bg-[#1C1917] flex items-center justify-center text-amber-400 text-xs font-bold">
                            {{ strtoupper(substr($depence->user->name, 0, 1)) }}
                        </div>
                        <span class="text-sm text-gray-600 truncate">{{ $depence->user->name }}</span>
                    </div>

                    <!-- Date -->
                    <div class="col-span-2">
                        <span
                            class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($depence->created_at)->format('d M Y') }}</span>
                    </div>

                    <!-- Amount -->
                    <div class="col-span-1 text-right">
                        <span class="text-sm font-bold text-[#1C1917]">{{ number_format($depence->amount, 2) }}
                            Dh</span>
                    </div>



                </div>
            @empty
                <div class="py-20 text-center">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center text-3xl mx-auto mb-5">
                        📋</div>
                    <h3 class="serif text-2xl text-[#1C1917] mb-2">Aucune dépense pour l'instant</h3>
                    <p class="text-gray-400 text-sm max-w-xs mx-auto mb-7 leading-relaxed">Ajoutez votre première
                        dépense partagée et CoLoc calculera les soldes automatiquement.</p>
                    <button onclick="document.getElementById('modal-expense').classList.remove('hidden')"
                        class="bg-[#1C1917] hover:bg-amber-500 text-white px-6 py-3 rounded-xl text-sm font-bold transition inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajouter une dépense
                    </button>
                </div>
            @endforelse

        </div>

    </main>


    <!-- ═══════════════════ MODAL: Ajouter dépense ═══════════════════ -->
    <div id="modal-expense"
        class="hidden fixed inset-0 bg-black/45 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative">

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
                        <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Montant (Dh) <span
                                class="text-red-400">*</span></label>
                        <input type="number" name="amount" step="0.01" placeholder="0.00"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-400 focus:outline-none" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Date <span
                                class="text-red-400">*</span></label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}"
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

</body>

</html>
