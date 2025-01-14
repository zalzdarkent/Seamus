<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('assets/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ asset('assets/js/google-map.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sections = document.querySelectorAll("section, footer"); // Tambahkan footer ke daftar section
        const navLinks = document.querySelectorAll(".navbar-nav .nav-item a");

        window.addEventListener("scroll", () => {
            let current = "";

            // Periksa setiap section dan footer
            sections.forEach((section) => {
                const sectionTop = section.offsetTop - 80; // Sesuaikan dengan tinggi navbar
                const sectionHeight = section.offsetHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop +
                    sectionHeight) {
                    current = section.getAttribute("id");
                }
            });

            // Tambahkan atau hapus kelas 'active' pada item navbar
            navLinks.forEach((link) => {
                link.parentElement.classList.remove("active");
                if (link.getAttribute("href").includes(current)) {
                    link.parentElement.classList.add("active");
                }
            });
        });

        // Guliran halus
        navLinks.forEach((link) => {
            link.addEventListener("click", (e) => {
                e.preventDefault();
                const targetId = link.getAttribute("href").substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop -
                        70, // Sesuaikan dengan tinggi navbar
                        behavior: "smooth",
                    });
                }
            });
        });
    });
</script>
