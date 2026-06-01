<x-filament::widget>
    <x-filament::card>
        <div class="space-y-4">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                    Premium Status
                </h2>
                @if($has_premium)
                    <x-filament::badge color="success" icon="heroicon-o-star">
                        Active
                    </x-filament::badge>
                @else
                    <x-filament::badge color="gray" icon="heroicon-o-x-circle">
                        Inactive
                    </x-filament::badge>
                @endif
            </div>

            <!-- Status Card -->
            <div class="@if($has_premium) bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 @else bg-gray-50 border border-gray-200 @endif rounded-lg p-4">
                <div class="flex items-center space-x-3">
                    @if($has_premium)
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                                <x-heroicon-o-star class="w-6 h-6 text-white"/>
                            </div>
                        </div>
                    @else
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                <x-heroicon-o-star class="w-6 h-6 text-gray-600"/>
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex-1 min-w-0">
                        @if($has_premium)
                            <p class="text-sm font-medium text-green-900">
                                Premium Plan Active
                            </p>
                            <p class="text-sm text-green-700">
                                Expires {{ \Carbon\Carbon::parse($end_date)->diffForHumans() }}
                            </p>
                        @else
                            <p class="text-sm font-medium text-gray-900">
                                Free Plan
                            </p>
                            <p class="text-sm text-gray-600">
                                Upgrade to unlock premium features
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Details -->
            @if($has_premium)
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="font-medium text-gray-500">Start Date</p>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($start_date)->format('M j, Y') }}</p>
                    </div>
                    <div>
                        <p class="font-medium text-gray-500">End Date</p>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($end_date)->format('M j, Y') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </x-filament::card>
</x-filament::widget>
