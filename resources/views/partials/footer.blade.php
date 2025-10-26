{{-- <footer class="border-t bg-background">
    <div class="container mx-auto px-6 pb-8 pt-12 md:pb-2">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <div class="space-y-4"><a href="/" class="inline-block"><img alt="Upskwela" class="h-auto w-32" src="/_astro/logo.BY9msEYF.svg"></a>
                <p class="text-sm leading-relaxed text-muted-foreground">Built for Filipinos, by Filipinos. Teach, learn, and earn with GCash &amp; Maya payments, AI tools, and a thriving community. Together, we're transforming Philippine education.</p>
            </div>
            <div class="hidden lg:block"></div>
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Join our Community</h3>
                <p class="text-sm text-muted-foreground">Connect with us on social media for updates, tips, and community highlights</p><a href="mailto:hello@upskwela.com" class="block text-sm text-primary transition-colors hover:text-primary/80">hello@upskwela.com</a>
                <div class="flex gap-3"><a href="https://www.facebook.com/upskwela" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-md border-b-4 border-blue-900/30 bg-primary text-primary-foreground shadow-sm transition-all duration-200 hover:bg-primary/90 hover:shadow-md active:scale-[0.98]" aria-label="Facebook"><img alt="Facebook" class="h-5 w-5" src="/_astro/facebook.CBDnsrw_.svg" style="filter: brightness(0) invert(1);"></a><a href="https://x.com/upskwela" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-md border-b-4 border-blue-900/30 bg-primary text-primary-foreground shadow-sm transition-all duration-200 hover:bg-primary/90 hover:shadow-md active:scale-[0.98]" aria-label="X (Twitter)"><img alt="X" class="h-5 w-5" src="/_astro/x.5ApPXOP2.svg" style="filter: brightness(0) invert(1);"></a><a href="https://www.tiktok.com/@upskwela" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-md border-b-4 border-blue-900/30 bg-primary text-primary-foreground shadow-sm transition-all duration-200 hover:bg-primary/90 hover:shadow-md active:scale-[0.98]" aria-label="TikTok"><img alt="TikTok" class="h-5 w-5" src="/_astro/tiktok.CQJZan1g.svg" style="filter: brightness(0) invert(1);"></a><a href="https://www.instagram.com/upskwela" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-md border-b-4 border-blue-900/30 bg-primary text-primary-foreground shadow-sm transition-all duration-200 hover:bg-primary/90 hover:shadow-md active:scale-[0.98]" aria-label="Instagram"><img alt="Instagram" class="h-5 w-5" src="/_astro/instagram.DwZvxPmU.svg" style="filter: brightness(0) invert(1);"></a><a href="https://www.youtube.com/@upskwela" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-md border-b-4 border-blue-900/30 bg-primary text-primary-foreground shadow-sm transition-all duration-200 hover:bg-primary/90 hover:shadow-md active:scale-[0.98]" aria-label="YouTube"><img alt="YouTube" class="h-5 w-5" src="/_astro/youtube.8_YaT57i.svg" style="filter: brightness(0) invert(1);"></a></div>
            </div>
        </div>
        <div class="mt-12 hidden border-t pt-4 sm:block">
            <div class="flex flex-wrap items-center justify-center gap-4 text-sm"><a href="/" class="text-muted-foreground transition-colors hover:text-primary">Home</a><span class="text-muted-foreground/30">•</span><a href="/communities" class="text-muted-foreground transition-colors hover:text-primary">Communities</a><span class="text-muted-foreground/30">•</span><a href="/#features" class="text-muted-foreground transition-colors hover:text-primary">Features</a><span class="text-muted-foreground/30">•</span><a href="/pricing" class="text-muted-foreground transition-colors hover:text-primary">Pricing</a><span class="text-muted-foreground/30">•</span><a href="/faqs" class="text-muted-foreground transition-colors hover:text-primary">FAQs</a><span class="text-muted-foreground/30">•</span><a href="/roadmap" class="text-muted-foreground transition-colors hover:text-primary">Roadmap</a></div>
        </div>
        <div class="mt-8 text-center md:mt-2">
            <p class="mt-8 text-base leading-6 text-center text-gray-400">
                &copy; {{ date('Y') }} SafeSupport, Inc. All rights reserved.
            </p>
        </div>
    </div>
</footer> --}}



<section class="bg-white border-t border-gray-200">
    <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 sm:px-6 lg:px-8">
        <nav class="flex flex-wrap justify-center -mx-5 -my-2">
            @php
                $links = ['About', 'Blog', 'Team', 'Pricing', 'Contact', 'Terms'];
            @endphp
            @foreach($links as $link)
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900 transition-colors duration-200">
                    {{ $link }}
                </a>
            </div>
            @endforeach
        </nav>

        <div class="flex justify-center mt-8 space-x-6">
            @php
                $socials = [
                    ['name' => 'Facebook', 'icon' => 'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z'],
                    ['name' => 'Instagram', 'icon' => 'M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63z'],
                    ['name' => 'Twitter', 'icon' => 'M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84'],
                ];
            @endphp

            @foreach($socials as $social)
            <a href="#" class="text-gray-400 hover:text-gray-500 transition-colors duration-200">
                <span class="sr-only">{{ $social['name'] }}</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="{{ $social['icon'] }}" />
                </svg>
            </a>
            @endforeach
        </div>

        {{-- Copyright --}}
        <p class="mt-8 text-base leading-6 text-center text-gray-400">
            &copy; {{ date('Y') }} SafeSupport, Inc. All rights reserved.
        </p>
    </div>
</section>
