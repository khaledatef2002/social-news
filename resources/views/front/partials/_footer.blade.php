<div id="footer-container">
    <footer class="bg-dark py-4">
        <div class="container-fluid px-2">
            <div class="d-flex flex-wrap flex-md-row flex-column gap-md-0 gap-4">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <img src="{{ $website_settings->logo }}" />
                </div>
                <div class="col-md-4 d-flex justify-content-evenly align-items-center">
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a target="_self" href="{{ route('front.terms') }}" class="text-white text-decoration-none">@lang('front.footer.terms')</a></li>
                        <li><a target="_self" href="{{ route('front.contact-us.index',) }}" class="text-white text-decoration-none">@lang('front.footer.contact-us')</a></li>
                        <li><a target="_self" href="{{ route('front.about') }}" class="text-white text-decoration-none">@lang('front.footer.about')</a></li>
                    </ul>
                </div>
                <div class="col-md-4 d-flex justify-content-center align-items-center gap-md-4 gap-5">
                    <a href="https://x.com/NewsPortal2025"><i class="fa-solid fa-x text-white fs-4"></i></a>
                    <a href="https://www.tiktok.com/@newsportal20?is_from_webapp=1&sender_device=pc"><i class="fab fa-tiktok text-white fs-4"></i></a>
                    <a href="https://www.youtube.com/@NewsPortal2025"><i class="fa-brands fa-youtube text-white fs-4"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <div id="terms-condition" class="text-center py-2">
        <p class="mb-0 text-white">@lang('front.copyright')</p>
    </div>
</div>