<!DOCTYPE html>
<html lang="en">

<head> @include('admin-temp.head')

</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    @include('admin-temp.sidebar_pkk')
    {{-- main content --}}
    <section class="pc-container">
        <div class="pc-content">
            @yield('content_admin')

        </div>
    </section>
    {{-- end content --}}
    @include('admin-temp.footer')
</body>

</html>
<div>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
</div>
