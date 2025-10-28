@extends('layout.master-student-2')
@section('title', 'Messages')

@section('body')
<section>
    <div class="h-full rounded-xl">
        <div class="w-full rounded-xl xs-w-full sm:w-full md:w-full lg:w-[24rem] md:rounded-xl border bg-white h-[80vh]">
            <div class="flex h-full flex-col">

                <!-- Header -->
                <div class="flex items-center justify-between rounded-t-xl border-b p-4">
                    <h2 class="text-lg font-semibold text-green-800">Messages</h2>
                </div>

                <!-- Tabs -->
                <div dir="ltr" data-orientation="horizontal" class="flex flex-1 flex-col overflow-hidden">

                    <!-- Tab List -->
                    <div role="tablist" aria-orientation="horizontal" class="inline-flex h-10 items-center justify-center rounded-md bg-gray-100 p-1 text-muted-foreground mx-4 mt-4 flex-shrink-0" tabindex="0" data-orientation="horizontal" style="outline: none;">

                        <!-- Private Tab -->
                        <button type="button" role="tab" aria-selected="true" aria-controls="radix-:rcf:-content-private" data-state="active" id="radix-:rcf:-trigger-private" class="inline-flex items-center justify-center text-green-800 whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm flex-1" tabindex="-1" data-orientation="horizontal" data-radix-collection-item>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle mr-2 h-4 w-4">
                                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                            </svg>
                            Private
                        </button>

                        <!-- Groups Tab -->
                        <button type="button" role="tab" aria-selected="false" aria-controls="radix-:rcf:-content-group" data-state="inactive" id="radix-:rcf:-trigger-group" class="inline-flex items-center justify-center text-green-800 whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm flex-1" tabindex="-1" data-orientation="horizontal" data-radix-collection-item>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users mr-2 h-4 w-4">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Groups
                        </button>

                    </div>

                    <!-- Tab Panels -->
                    <div class="flex-1 overflow-y-auto">

                        <!-- Private Panel -->
                        <div data-state="active" data-orientation="horizontal" role="tabpanel" aria-labelledby="radix-:rcf:-trigger-private" id="radix-:rcf:-content-private" tabindex="0" class="ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 m-0 h-full">
                            <div class="flex flex-col items-center justify-center p-8 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle mb-4 h-12 w-12 text-green-600">
                                    <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                                </svg>
                                <p class="text-sm text-muted-foreground text-green-800">No conversations yet</p>
                            </div>
                        </div>

                        <!-- Groups Panel -->
                        <div data-state="inactive" data-orientation="horizontal" role="tabpanel" aria-labelledby="radix-:rcf:-trigger-group" hidden="" id="radix-:rcf:-content-group" tabindex="0" class="ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 m-0 h-full">
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
@endsection
