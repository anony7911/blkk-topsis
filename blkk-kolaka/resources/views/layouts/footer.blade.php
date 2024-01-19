        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">{{ config('app.name') }}</a>.</strong>

            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @livewireScripts
        @stack('alertScript')
        </body>
        </html>
