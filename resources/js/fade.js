document.addEventListener("DOMContentLoaded", () => {
    const prefersReduced = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;

    const show = ["opacity-100", "translate-y-0"];
    const hide = ["opacity-0", "translate-y-2"];

    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                const el = entry.target;

                if (prefersReduced) {
                    el.classList.remove(...hide);
                    el.classList.add("opacity-100");
                    io.unobserve(el);
                    return;
                }

                if (entry.isIntersecting) {
                    el.classList.remove(...hide);
                    el.classList.add(...show);
                } else {
                    el.classList.remove(...show);
                    el.classList.add(...hide);
                }
            });
        },
        { threshold: 0.15 }
    );

    document.querySelectorAll("[data-fade]").forEach((el) => io.observe(el));
});
