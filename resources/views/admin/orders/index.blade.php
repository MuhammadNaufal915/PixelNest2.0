@extends('layouts.app')

@section('title', 'Purchase History - Admin')

@section('content')
    <div class="min-h-screen bg-black py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div class="animate-fade-in">
                    <div class="flex items-center gap-4 mb-2">
                        <a href="{{ route('admin.dashboard') }}"
                            class="p-2 bg-zinc-900 text-zinc-400 hover:text-white rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                        <h1 class="text-4xl font-bold text-white">Purchase History</h1>
                    </div>
                    <p class="text-zinc-400 ml-14">Monitor and manage all transactions across the platform</p>
                </div>

                {{-- Stats Cards --}}
                <div class="flex gap-4 animate-slide-up">
                    {{-- Volume Card --}}
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-4 flex items-center gap-4 min-w-[200px]">
                        <div class="w-12 h-12 rounded-xl bg-zinc-800 flex items-center justify-center">
                            <svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-zinc-500 text-xs font-bold uppercase tracking-wider mb-1">Volume</p>
                            <p class="text-2xl font-bold text-white">{{ $totalOrders }} <span
                                    class="text-sm font-normal text-zinc-500">Transactions</span></p>
                        </div>
                    </div>

                    {{-- Revenue Card --}}
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-4 flex items-center gap-4 min-w-[260px]">
                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <p class="text-zinc-500 text-xs font-bold uppercase tracking-wider">Platform Revenue</p>
                                <span
                                    class="px-1.5 py-0.5 rounded text-[10px] bg-green-900/30 text-green-400 font-bold">+12.5%</span>
                            </div>
                            <p class="text-2xl font-bold text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Controls Bar --}}
            <div class="flex flex-col md:flex-row gap-4 mb-6 animate-slide-up" style="animation-delay: 0.1s;">
                <div class="flex-1 relative">
                    <svg class="w-5 h-5 text-zinc-500 absolute left-4 top-3.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Search by order # or customer..."
                        class="w-full bg-zinc-900 border border-zinc-800 text-white pl-12 pr-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all placeholder-zinc-600">
                </div>
                <div class="flex gap-4">
                    <button
                        class="px-6 py-3 bg-zinc-900 border border-zinc-800 text-zinc-300 rounded-xl font-medium hover:bg-zinc-800 transition-colors">
                        All Status
                    </button>
                    <a href="{{ route('admin.orders.export') }}"
                        class="px-6 py-3 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transform hover:scale-105 transition-all text-center flex items-center gap-2">
                        <span>Export CSV</span>
                    </a>
                </div>
            </div>

            {{-- Orders Table --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden animate-slide-up shadow-xl shadow-black/50"
                style="animation-delay: 0.2s;">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-zinc-900/50 border-b border-zinc-800">
                                <th
                                    class="px-8 py-5 text-left text-[10px] font-bold text-zinc-500 uppercase tracking-widest">
                                    Order Details</th>
                                <th
                                    class="px-8 py-5 text-left text-[10px] font-bold text-zinc-500 uppercase tracking-widest">
                                    Customer</th>
                                <th
                                    class="px-8 py-5 text-center text-[10px] font-bold text-zinc-500 uppercase tracking-widest">
                                    Items</th>
                                <th
                                    class="px-8 py-5 text-right text-[10px] font-bold text-zinc-500 uppercase tracking-widest">
                                    Amount</th>
                                <th
                                    class="px-8 py-5 text-center text-[10px] font-bold text-zinc-500 uppercase tracking-widest">
                                    Status</th>
                                <th
                                    class="px-8 py-5 text-right text-[10px] font-bold text-zinc-500 uppercase tracking-widest">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800">
                            @forelse($orders as $order)
                                <tr class="group hover:bg-zinc-800/50 transition-colors duration-200">
                                    {{-- Order Details --}}
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-white text-lg mb-1">#{{ $order->order_number }}</span>
                                            <span
                                                class="text-xs text-zinc-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    </td>

                                    {{-- Customer --}}
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-zinc-800 flex items-center justify-center border border-zinc-700 font-bold text-zinc-400">
                                                {{ substr($order->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-bold text-white text-sm">{{ $order->user->name }}</span>
                                                <span class="text-xs text-zinc-500">{{ $order->user->email }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Items --}}
                                    <td class="px-8 py-6 text-center">
                                        <span
                                            class="px-3 py-1 bg-zinc-950 border border-zinc-800 rounded-full text-xs text-zinc-400">
                                            {{ $order->items->count() }} item(s)
                                        </span>
                                    </td>

                                    {{-- Amount --}}
                                    <td class="px-8 py-6 text-right">
                                        <span class="font-bold text-white">Rp
                                            {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-8 py-6 text-center">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border
                                                @if($order->status === 'completed') bg-green-900/20 text-green-400 border-green-900/50
                                                @elseif($order->status === 'pending') bg-yellow-900/20 text-yellow-400 border-yellow-900/50
                                                @else bg-red-900/20 text-red-400 border-red-900/50 @endif">
                                            {{ $order->status }}
                                        </span>
                                    </td>

                                    {{-- Action --}}
                                    <td class="px-8 py-6 text-right">
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                            class="inline-flex p-2 text-zinc-400 hover:text-white bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 rounded-lg transition-all transform group-hover:scale-105">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-16 text-center text-zinc-500">
                                        No orders found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection