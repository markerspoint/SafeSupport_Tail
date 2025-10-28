@extends('layout.master-student-2')
@section('title', 'Notifications')

@section('body')

<section>
    <div class="pb-16 md:pb-0">
        <div class="w-full px-4 py-6 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="flex flex-col gap-2">
                    <h1 class="text-2xl font-bold font-sans sm:text-3xl text-green-800">Notifications</h1>
                    <p class="text-muted-foreground font-sans text-green-800">
                        Stay updated with the latest activities in your communities.
                    </p>
                </div>
            </div>

            <div class="space-y-4">
                <div dir="ltr" data-orientation="horizontal">
                    <div role="tablist" aria-orientation="horizontal" class="h-10 items-center justify-center rounded-md bg-gray-100 p-1 text-green-800 font-sans
                            grid w-full max-w-[500px] grid-cols-4" tabindex="0" data-orientation="horizontal" style="outline: none;">

                        <button type="button" role="tab" aria-selected="true" aria-controls="radix-:rca:-content-all" data-state="active" id="radix-:rca:-trigger-all" class="justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium
                                   ring-offset-background transition-all focus-visible:outline-none
                                   focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2
                                   disabled:pointer-events-none disabled:opacity-50
                                   data-[state=active]:bg-background data-[state=active]:text-foreground
                                   data-[state=active]:shadow-sm flex items-center gap-1" tabindex="-1" data-orientation="horizontal" data-radix-collection-item>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell h-3 w-3">
                                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                            </svg>
                            All
                        </button>

                        <button type="button" role="tab" aria-selected="false" aria-controls="radix-:rca:-content-unread" data-state="inactive" id="radix-:rca:-trigger-unread" class="justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium
                                   ring-offset-background transition-all focus-visible:outline-none
                                   focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2
                                   disabled:pointer-events-none disabled:opacity-50
                                   data-[state=active]:bg-background data-[state=active]:text-foreground
                                   data-[state=active]:shadow-sm flex items-center gap-1" tabindex="-1" data-orientation="horizontal" data-radix-collection-item>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle h-3 w-3">
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            Unread
                        </button>

                        <button type="button" role="tab" aria-selected="false" aria-controls="radix-:rca:-content-read" data-state="inactive" id="radix-:rca:-trigger-read" class="justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium
                                   ring-offset-background transition-all focus-visible:outline-none
                                   focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2
                                   disabled:pointer-events-none disabled:opacity-50
                                   data-[state=active]:bg-background data-[state=active]:text-foreground
                                   data-[state=active]:shadow-sm flex items-center gap-1" tabindex="-1" data-orientation="horizontal" data-radix-collection-item>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check h-3 w-3">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="m9 12 2 2 4-4"></path>
                            </svg>
                            Read
                        </button>

                        <button type="button" role="tab" aria-selected="false" aria-controls="radix-:rca:-content-archived" data-state="inactive" id="radix-:rca:-trigger-archived" class="justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium
                                   ring-offset-background transition-all focus-visible:outline-none
                                   focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2
                                   disabled:pointer-events-none disabled:opacity-50
                                   data-[state=active]:bg-background data-[state=active]:text-foreground
                                   data-[state=active]:shadow-sm flex items-center gap-1" tabindex="-1" data-orientation="horizontal" data-radix-collection-item>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-archive h-3 w-3">
                                <rect width="20" height="5" x="2" y="3" rx="1"></rect>
                                <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"></path>
                                <path d="M10 12h4"></path>
                            </svg>
                            Archived
                        </button>
                    </div>

                    <div data-state="active" data-orientation="horizontal" role="tabpanel" aria-labelledby="radix-:rca:-trigger-all" id="radix-:rca:-content-all" tabindex="0" class="ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 mt-4">
                        <div class="flex flex-col items-center justify-center py-12 text-center">
                            <div class="mx-auto mb-4 flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox h-12 w-12 text-green-600">
                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                    <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold font-sans text-green-800">No notifications</h3>
                            <p class="text-sm font-sans text-green-800">
                                You're all caught up! Check back later for new updates.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection
